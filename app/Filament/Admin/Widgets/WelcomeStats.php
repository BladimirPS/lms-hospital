<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class WelcomeStats extends StatsOverviewWidget
{
    protected static ?int $sort = -9999;

    protected function getStats(): array
    {
        $user = auth()->user();
        $role = $user->getRoleNames()->first();
        $roleLabel = match($role) {
            'superadmin' => 'Superadministrador',
            'encargado'  => 'Encargado de Departamento',
            default      => 'Usuario',
        };

        return [
            Stat::make('Usuario', $user->first_name . ' ' . $user->last_name)
                ->description($roleLabel)
                ->icon('heroicon-o-user-circle')
                ->color('primary'),

            Stat::make('Cursos publicados', Course::where('status', 'published')->count())
                ->description('Cursos activos en el sistema')
                ->icon('heroicon-o-academic-cap')
                ->color('success'),

            Stat::make('Total inscripciones', Enrollment::count())
                ->description(Enrollment::where('status', 'completed')->count() . ' completadas')
                ->icon('heroicon-o-clipboard-document-check')
                ->color('warning'),

            Stat::make('Empleados registrados', User::role('estudiante')->count())
                ->description('Personal activo en el sistema')
                ->icon('heroicon-o-users')
                ->color('info'),
        ];
    }
}
