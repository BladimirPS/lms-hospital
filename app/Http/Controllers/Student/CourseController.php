<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\LessonProgress;
use Illuminate\Http\Request;
use App\Models\ExamAttempt;

class CourseController extends Controller
{
    public function show(Enrollment $enrollment)
    {
        $enrollment->load(['course.modules.lessons', 'lessonProgress']);

        $allLessons = $enrollment->course->modules->flatMap->lessons;

        // Lección actual
        $currentLesson = request('lesson')
            ? $allLessons->firstWhere('id', request('lesson'))
            : $allLessons->first();

        // Marcar automáticamente como vista
        if ($currentLesson) {
            LessonProgress::firstOrCreate([
                'enrollment_id' => $enrollment->id,
                'lesson_id'     => $currentLesson->id,
            ], [
                'viewed'    => true,
                'viewed_at' => now(),
            ]);

            // Recalcular progreso
            $totalLessons  = $allLessons->count();
            $viewedLessons = LessonProgress::where('enrollment_id', $enrollment->id)
                ->where('viewed', true)
                ->count();

            $enrollment->update([
                'progress' => $totalLessons > 0
                    ? (int) round(($viewedLessons / $totalLessons) * 100)
                    : 0,
            ]);

            // Recargar el progreso actualizado
            $enrollment->load('lessonProgress');
        }

        // Lección siguiente
        $currentIndex  = $allLessons->search(fn ($l) => $l->id === $currentLesson?->id);
        $nextLesson    = $allLessons->get($currentIndex + 1);

        return view('student.course', compact('enrollment', 'currentLesson', 'nextLesson'));
    }
    public function exam(Enrollment $enrollment)
{
    $enrollment->load(['course.exam.questions.options']);

    $questions = $enrollment->course->exam->questions->shuffle();

    return view('student.exam', compact('enrollment', 'questions'));
}

public function submitExam(Enrollment $enrollment, Request $request)
{
    $enrollment->load(['course.exam.questions.options']);

    $questions   = $enrollment->course->exam->questions;
    $answers     = $request->input('answers', []);
    $correct     = 0;
    $total       = $questions->count();

    foreach ($questions as $question) {
        $selected = $answers[$question->id] ?? [];
        if (!is_array($selected)) {
            $selected = [$selected];
        }

        $correctOptions = $question->options
            ->where('is_correct', true)
            ->pluck('id')
            ->map(fn($id) => (string) $id)
            ->sort()
            ->values();

        $selectedSorted = collect($selected)
            ->map(fn($id) => (string) $id)
            ->sort()
            ->values();

        if ($correctOptions->toArray() === $selectedSorted->toArray()) {
            $correct++;
        }
    }

    $score  = $total > 0 ? round(($correct / $total) * 100, 2) : 0;
    $passed = $score >= $enrollment->course->minimum_score;

    // Registrar intento
    $attempt = $enrollment->attempts()->create([
        'attempt_number' => $enrollment->attempts()->count() + 1,
        'started_at'     => now(),
        'finished_at'    => now(),
        'score'          => $score,
        'passed'         => $passed,
        'completed'      => true,
    ]);

    // Guardar respuestas
    foreach ($questions as $question) {
        $selected = $answers[$question->id] ?? [];
        if (!is_array($selected)) {
            $selected = [$selected];
        }
        foreach ($selected as $optionId) {
            $option = $question->options->firstWhere('id', $optionId);
            if ($option) {
                $attempt->answers()->create([
                    'question_id' => $question->id,
                    'option_id'   => $optionId,
                    'is_correct'  => $option->is_correct,
                ]);
            }
        }
    }

    // Actualizar inscripción si aprobó
    if ($passed) {
        $enrollment->update(['status' => 'completed']);
    }

    return redirect()->route('student.exam.result', [$enrollment, $attempt]);
}
public function examResult(Enrollment $enrollment, ExamAttempt $attempt)
{
    return view('student.exam-result', compact('enrollment', 'attempt'));
}
}
