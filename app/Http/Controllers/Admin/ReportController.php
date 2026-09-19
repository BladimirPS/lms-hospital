<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Diploma;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        // Estadísticas generales
        $totalUsers       = User::role('estudiante')->count();
        $totalCourses     = Course::where('status', 'published')->count();
        $totalEnrollments = Enrollment::count();
        $totalCompleted   = Enrollment::where('status', 'completed')->count();
        $totalDiplomas    = Diploma::count();

        // Cursos con más inscripciones
        $topCourses = Course::withCount('enrollments')
            ->orderBy('enrollments_count', 'desc')
            ->take(5)
            ->get();

        // Empleados sin completar cursos obligatorios
        $pendingUsers = User::role('estudiante')
            ->whereHas('enrollments', fn($q) => $q->where('status', 'in_progress'))
            ->with(['enrollments.course', 'section'])
            ->get();

        // Progreso por curso
        $courseProgress = Course::where('status', 'published')
            ->withCount([
                'enrollments',
                'enrollments as completed_count' => fn($q) => $q->where('status', 'completed')
            ])
            ->get();

        return view('admin.reports', compact(
            'totalUsers',
            'totalCourses',
            'totalEnrollments',
            'totalCompleted',
            'totalDiplomas',
            'topCourses',
            'pendingUsers',
            'courseProgress'
        ));
    }

    public function exportExcel()
    {
        return Excel::download(new \App\Exports\EnrollmentsExport, 'reporte-inscripciones.xlsx');
    }

    public function exportPdf()
    {
        $courseProgress = Course::where('status', 'published')
            ->withCount([
                'enrollments',
                'enrollments as completed_count' => fn($q) => $q->where('status', 'completed')
            ])
            ->get();

        $totalUsers     = User::role('estudiante')->count();
        $totalCompleted = Enrollment::where('status', 'completed')->count();
        $totalDiplomas  = Diploma::count();

        $pdf = Pdf::loadView('admin.reports-pdf', compact(
            'courseProgress',
            'totalUsers',
            'totalCompleted',
            'totalDiplomas'
        ));

        return $pdf->download('reporte-lms-hgo.pdf');
    }
}
