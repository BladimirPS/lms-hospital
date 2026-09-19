<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;

use App\Models\Enrollment;

class CatalogController extends Controller
{
    public function index()
    {
        $courses = Course::where('status', 'published')
            ->where('is_free_choice', true)
            ->with('sections')
            ->get();

        return view('student.catalog', compact('courses'));
    }
    public function enroll(Course $course)
{
    if (!$course->is_free_choice || $course->status !== 'published') {
        abort(403);
    }

    Enrollment::firstOrCreate([
        'user_id'   => auth()->id(),
        'course_id' => $course->id,
    ], [
        'status'      => 'in_progress',
        'progress'    => 0,
        'enrolled_at' => now(),
    ]);

    return redirect()->route('student.dashboard')
        ->with('success', 'Te has inscrito en el curso exitosamente.');
}
}
