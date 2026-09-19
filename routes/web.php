<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\CatalogController;
use App\Http\Controllers\Student\CourseController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\DiplomaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReportController;

// Ruta raíz — redirige según rol
Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('encargado')) {
        return redirect('/admin');
    }

    return redirect()->route('student.dashboard');
});


Route::middleware(['auth', \Spatie\Permission\Middleware\RoleMiddleware::using('superadmin|encargado')])
    ->prefix('admin-reportes')
    ->name('admin.')
    ->group(function () {
        Route::get('/reportes', [ReportController::class, 'index'])->name('reports');
        Route::get('/reportes/excel', [ReportController::class, 'exportExcel'])->name('reports.excel');
        Route::get('/reportes/pdf', [ReportController::class, 'exportPdf'])->name('reports.pdf');
    });

// Perfil
Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Portal del estudiante
Route::middleware(['auth', 'verified'])->prefix('estudiante')->name('student.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/catalogo', [CatalogController::class, 'index'])->name('catalog');
    Route::get('/cursos/{enrollment}', [CourseController::class, 'show'])->name('course.show');
    Route::get('/diplomas', [DiplomaController::class, 'index'])->name('diplomas');
    Route::post('/cursos/{enrollment}/leccion/{lesson}/completar', [CourseController::class, 'completeLesson'])->name('lesson.complete');
    Route::post('/catalogo/{course}/inscribirse', [CatalogController::class, 'enroll'])->name('catalog.enroll');
    Route::get('/cursos/{enrollment}/evaluacion', [CourseController::class, 'exam'])->name('exam');
    Route::post('/cursos/{enrollment}/evaluacion/enviar', [CourseController::class, 'submitExam'])->name('exam.submit');
    Route::get('/cursos/{enrollment}/evaluacion/resultado/{attempt}', [CourseController::class, 'examResult'])->name('exam.result');
    Route::get('/mis-cursos', [DashboardController::class, 'inProgress'])->name('courses.progress');
Route::get('/cursos-completados', [DashboardController::class, 'completed'])->name('courses.completed');
});

require __DIR__.'/auth.php';
