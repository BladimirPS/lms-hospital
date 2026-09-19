<?php

namespace App\Exports;

use App\Models\Enrollment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EnrollmentsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Enrollment::with(['user', 'course'])->get();
    }

    public function headings(): array
    {
        return [
            'Empleado',
            'Correo',
            'Sección',
            'Curso',
            'Tipo',
            'Estado',
            'Progreso (%)',
            'Fecha inscripción',
            'Fecha completado',
        ];
    }

    public function map($enrollment): array
    {
        return [
            $enrollment->user->first_name . ' ' . $enrollment->user->last_name,
            $enrollment->user->email,
            $enrollment->user->section->name ?? 'Sin sección',
            $enrollment->course->title,
            $enrollment->course->type === 'talk' ? 'Charla' : 'Taller',
            match($enrollment->status) {
                'in_progress' => 'En progreso',
                'completed'   => 'Completado',
                'abandoned'   => 'Abandonado',
                default       => $enrollment->status,
            },
            $enrollment->progress,
            $enrollment->enrolled_at?->format('d/m/Y'),
            $enrollment->completed_at?->format('d/m/Y') ?? 'Pendiente',
        ];
    }
}
