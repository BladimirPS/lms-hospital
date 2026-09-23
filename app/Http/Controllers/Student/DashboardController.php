<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $enrollments = $user->enrollments()
            ->with(['course'])
            ->whereHas('course', fn($q) => $q->where('status', 'published'))
            ->orderBy('updated_at', 'desc')
            ->get();

        $inProgress = $enrollments->where('status', 'in_progress')->map(function ($enrollment) {
            $enrollment->is_locked      = $enrollment->isLocked();
            $enrollment->is_not_started = $enrollment->isNotStarted();
            return $enrollment;
        });

        $completed = $enrollments->where('status', 'completed');
        $diplomas    = $user->enrollments()
            ->with(['diploma', 'course'])
            ->whereHas('diploma')
            ->get();

        return view('student.dashboard', compact(
            'user',
            'inProgress',
            'completed',
            'diplomas'
        ));
    }
    public function inProgress()
    {
        $enrollments = Auth::user()->enrollments()
            ->with(['course'])
            ->where('status', 'in_progress')
            ->whereHas('course', fn($q) => $q->where('status', 'published'))
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('student.courses-progress', compact('enrollments'));
    }

    public function completed()
    {
        $enrollments = Auth::user()->enrollments()
            ->with(['course', 'diploma'])
            ->where('status', 'completed')
            ->whereHas('course', fn($q) => $q->where('status', 'published'))
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('student.courses-completed', compact('enrollments'));
    }
}
