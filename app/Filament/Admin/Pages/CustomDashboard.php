<?php

namespace App\Filament\Admin\Pages;
use BackedEnum;
use Filament\Support\Icons\Heroicon;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Diploma;
use Filament\Pages\Page;

class CustomDashboard extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;
    //protected static ?string $navigationLabel = 'Escritorio';
    protected static ?string $title = 'Escritorio';
    protected static ?int $navigationSort = -1;

    protected string $view = 'filament.admin.pages.custom-dashboard';

    public $totalUsers;
    public $totalCourses;
    public $totalEnrollments;
    public $totalCompleted;
    public $totalDiplomas;
    public $topCourses;
    public $courseProgress;
    public $pendingUsers;

    public function mount(): void
    {
        $this->totalUsers       = User::role('estudiante')->count();
        $this->totalCourses     = Course::where('status', 'published')->count();
        $this->totalEnrollments = Enrollment::count();
        $this->totalCompleted   = Enrollment::where('status', 'completed')->count();
        $this->totalDiplomas    = Diploma::count();

        $this->topCourses = Course::withCount('enrollments')
            ->orderBy('enrollments_count', 'desc')
            ->take(5)
            ->get();

        $this->courseProgress = Course::where('status', 'published')
            ->withCount([
                'enrollments',
                'enrollments as completed_count' => fn($q) => $q->where('status', 'completed')
            ])
            ->get();

        $this->pendingUsers = User::role('estudiante')
            ->whereHas('enrollments', fn($q) => $q->where('status', 'in_progress'))
            ->with(['enrollments.course', 'section'])
            ->get();
    }

}
