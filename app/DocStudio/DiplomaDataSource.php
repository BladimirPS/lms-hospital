<?php

namespace App\DocStudio;

use App\Models\Enrollment;
use TommasoMusetti\DocStudio\Contracts\DocumentDataSource;

class DiplomaDataSource implements DocumentDataSource
{
    public static function model(): string
    {
        return Enrollment::class;
    }

    public function fields(): array
    {
        return [
            'employee_name' => [
                'label'    => 'Nombre del empleado',
                'resolver' => fn (Enrollment $e): string =>
                    trim("{$e->user->first_name} {$e->user->middle_name} {$e->user->last_name} {$e->user->second_last_name}"),
            ],
            'course_title' => [
                'label'    => 'Título del curso',
                'resolver' => fn (Enrollment $e): string => $e->course->title,
            ],
            'section_name' => [
                'label'    => 'Sección',
                'resolver' => fn (Enrollment $e): string => $e->user->section?->name ?? 'N/A',
            ],
            'position_name' => [
                'label'    => 'Puesto',
                'resolver' => fn (Enrollment $e): string => $e->user->position?->name ?? 'N/A',
            ],
            'obtained_score' => [
                'label'    => 'Nota obtenida',
                'resolver' => fn (Enrollment $e): string => $e->diploma?->obtained_score . '%' ?? 'N/A',
            ],
            'diploma_code' => [
                'label'    => 'Código de diploma',
                'resolver' => fn (Enrollment $e): string => $e->diploma?->diploma_code ?? 'N/A',
            ],
            'issued_at' => [
                'label'    => 'Fecha de emisión',
                'resolver' => fn (Enrollment $e): string =>
                    $e->diploma?->issued_at
                        ? \Carbon\Carbon::parse($e->diploma->issued_at)->locale('es')->isoFormat('D [de] MMMM [de] YYYY')
                        : 'N/A',
            ],
            'hospital_name' => [
                'label'    => 'Nombre del hospital',
                'resolver' => fn (Enrollment $e): string => 'Hospital Regional de Occidente',
            ],
        ];
    }

    public function collections(): array
    {
        return [];
    }

    public function sample(): Enrollment
    {
        return Enrollment::with(['user.section', 'user.position', 'course', 'diploma'])
            ->whereHas('diploma')
            ->latest()
            ->first() ?? new Enrollment();
    }
}
