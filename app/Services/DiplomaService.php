<?php

namespace App\Services;

use App\Models\Diploma;
use App\Models\DiplomaSettings;
use App\Models\Enrollment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class DiplomaService
{
    public function generate(Enrollment $enrollment, $attempt): Diploma
    {
        $settings = DiplomaSettings::first();

        // Crear o actualizar el diploma
        $diploma = Diploma::updateOrCreate(
            ['enrollment_id' => $enrollment->id],
            [
                'attempt_id'     => $attempt->id,
                'diploma_code'   => 'HGO-' . strtoupper(Str::random(8)),
                'manager_name'   => $settings?->director_name ?? 'Director Ejecutivo',
                'obtained_score' => $attempt->score,
                'issued_at'      => now(),
            ]
        );

        // Generar PDF
        $enrollment->load(['user.section', 'user.position', 'course']);

        $pdf = Pdf::loadView('diplomas.template', [
            'enrollment' => $enrollment,
            'diploma'    => $diploma,
            'settings'   => $settings,
        ])->setPaper('letter', 'landscape');

        // Guardar PDF
        $path = 'diplomas/' . $diploma->diploma_code . '.pdf';
        $pdf->save(storage_path('app/public/' . $path));

        // Actualizar ruta del PDF
        $diploma->update(['pdf_path' => $path]);

        return $diploma;
    }
}
