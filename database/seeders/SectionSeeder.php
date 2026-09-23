<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\Subdirection;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            // Subdirección Administrativa Financiera
            'Subdirección Administrativa Financiera' => [
                'Presupuesto',
                'Contabilidad',
                'Tesorería',
                'Almacén',
                'Inventarios',
                'Compras',
                'Eventos y Adquisiciones',
                'Bodega Médico Quirúrgico',
                'Bodega de Alimentos',
                'Bodega de Medicamentos',
                'Farmacia Interna',
            ],

            // Subdirección Médica
            'Subdirección Médica' => [
                'Anestesia',
                'Ginecología y Obstetricia',
                'Ortopedia y Traumatología',
                'Cirugía',
                'Radiología',
                'Medicina Interna',
                'Pediatría',
                'Banco de Leche Materna',
                'Odontología',
                'Terapia Respiratoria',
                'Clínica Integral del Adolescente',
                'Clínica de Violencia Sexual y Maltrato Infantil',
                'Clínica Integral de la Mujer',
                'Unidad de Hemodiálisis',
            ],

            // Subdirección de Enfermería
            'Subdirección de Enfermería' => [
                'Cuidados Generales',
                'Cuidados Críticos',
                'Salas de Hospitalización',
                'Área Verde',
                'Intensivos',
                'Labor y Partos',
                'Emergencia',
                'Consulta Externa',
                'Lactario',
                'Cocina',
            ],

            // Subdirección Técnica
            'Subdirección Técnica' => [
                'Servicios de Apoyo',
                'Registros Médicos y Estadística',
                'Trabajo Social',
                'Atención al Usuario',
                'Alimentación y Nutrición',
                'Epidemiología',
                'Auxiliares de Tratamiento',
                'Unidad de Atención Psicosocial',
                'Unidad de Atención Integral (VIH)',
                'Fisioterapia',
                'Auxiliares de Diagnóstico',
                'Laboratorio Clínico y Biología Molecular',
                'Patología',
                'Banco de Sangre',
            ],

            // Coordinación de Recursos Humanos
            'Coordinación de Recursos Humanos' => [
                'Jefe de Personal',
                'Secretaría de RRHH',
                'Sección de Dotación',
                'Sección de Capacitación',
                'Analista Renglón 011',
                'Analista de Contratos',
                'Sueldos y Salarios',
                'Control y Marcaje',
            ],

            // Subdirección de Servicios Generales
            'Subdirección de Servicios Generales' => [
                'Resguardo y Vigilancia',
                'Mantenimiento',
                'Intendencia',
                'Lavandería',
                'Transportes',
                'Imprenta',
                'Planta Telefónica',
                'Costurería',
            ],
        ];

        foreach ($sections as $subdirectionName => $sectionNames) {
            $subdirection = Subdirection::where('name', $subdirectionName)->first();
            if ($subdirection) {
                foreach ($sectionNames as $sectionName) {
                    Section::create([
                        'name'             => $sectionName,
                        'subdirection_id'  => $subdirection->id,
                    ]);
                }
            }
        }
    }
}
