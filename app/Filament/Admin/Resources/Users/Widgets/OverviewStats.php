<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Course;
use App\Models\Diploma;
use App\Models\Enrollment;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OverviewStats extends BaseWidget
{
    protected function getStats(): array
    {
        $activeCourses = Course::where('status', 'published')->count();

        $totalActiveUsers = User::where('active', true)->count();
        $enrolledUsers = Enrollment::distinct('user_id')->count('user_id');
        $coverage = $totalActiveUsers > 0
            ? round(($enrolledUsers / $totalActiveUsers) * 100, 1)
            : 0;

        $diplomasIssued = Diploma::count();

        $atRisk = User::where('active', true)
            ->whereDoesntHave('enrollments', function ($q) {
                $q->whereHas('course', fn ($c) => $c->where('due_date', '>=', now()));
            })
            ->count();

        return [
            Stat::make('Cursos activos', $activeCourses)
                ->description('Publicados actualmente')
                ->color('primary'),

            Stat::make('Cobertura del personal', "{$coverage}%")
                ->description("{$enrolledUsers} de {$totalActiveUsers} empleados")
                ->color($coverage >= 80 ? 'success' : 'warning'),

            Stat::make('Diplomas emitidos', $diplomasIssued)
                ->description('Total histórico')
                ->color('info'),

            Stat::make('Empleados sin progreso', $atRisk)
                ->description('Sin inscripción a cursos vigentes')
                ->color($atRisk > 0 ? 'danger' : 'success'),
        ];
    }
}
