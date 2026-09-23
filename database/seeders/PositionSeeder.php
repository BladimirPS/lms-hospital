<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;
use App\Models\Section;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [
            // Capacitación (RRHH)
            'Capacitación' => [
                'Encargado de Capacitación',
                'Instructor',
                'Auxiliar de Capacitación',
            ],
            // Jefatura de Personal
            'Jefatura de Personal' => [
                'Jefe de Personal',
                'Asistente de Personal',
            ],
            // Sueldos y Salarios
            'Sueldos y Salarios' => [
                'Encargado de Sueldos',
                'Auxiliar de Nómina',
            ],
            // Anestesia
            'Anestesia' => [
                'Médico Anestesiólogo',
                'Enfermero/a de Anestesia',
            ],
            // Cirugía
            'Cirugía' => [
                'Médico Cirujano',
                'Enfermero/a de Cirugía',
                'Auxiliar de Cirugía',
            ],
            // Radiología
            'Radiología' => [
                'Radiólogo',
                'Técnico en Radiología',
            ],
            // Medicina Interna
            'Medicina Interna' => [
                'Médico Internista',
                'Residente de Medicina Interna',
            ],
            // Pediatría
            'Pediatría' => [
                'Médico Pediatra',
                'Enfermero/a de Pediatría',
            ],
            // Ginecología y Obstetricia
            'Ginecología y Obstetricia' => [
                'Médico Ginecólogo',
                'Enfermero/a de Ginecología',
            ],
            // Cuidados Generales
            'Cuidados Generales' => [
                'Enfermero/a General',
                'Auxiliar de Enfermería',
            ],
            // Emergencia
            'Emergencia' => [
                'Médico de Emergencia',
                'Enfermero/a de Emergencia',
                'Auxiliar de Emergencia',
            ],
            // Laboratorio Clínico
            'Laboratorio Clínico' => [
                'Laboratorista',
                'Auxiliar de Laboratorio',
            ],
            // Trabajo Social
            'Trabajo Social' => [
                'Trabajador/a Social',
            ],
            // Mantenimiento
            'Mantenimiento' => [
                'Técnico de Mantenimiento',
                'Auxiliar de Mantenimiento',
            ],
            // Contabilidad
            'Contabilidad' => [
                'Contador/a',
                'Auxiliar de Contabilidad',
            ],
            // Farmacia Interna
            'Farmacia Interna' => [
                'Farmacéutico/a',
                'Auxiliar de Farmacia',
            ],
        ];

        foreach ($positions as $sectionName => $positionNames) {
            $section = Section::where('name', $sectionName)->first();
            if ($section) {
                foreach ($positionNames as $positionName) {
                    Position::create([
                        'name'       => $positionName,
                        'section_id' => $section->id,
                    ]);
                }
            }
        }
    }
}
