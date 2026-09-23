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
            // Subdirección Administrativa Financiera
            'Presupuesto'              => ['Encargado de Presupuesto', 'Analista de Presupuesto'],
            'Contabilidad'             => ['Contador/a', 'Auxiliar de Contabilidad'],
            'Tesorería'                => ['Tesorero/a', 'Auxiliar de Tesorería'],
            'Almacén'                  => ['Encargado de Almacén', 'Auxiliar de Almacén'],
            'Inventarios'              => ['Encargado de Inventarios', 'Auxiliar de Inventarios'],
            'Compras'                  => ['Encargado de Compras', 'Auxiliar de Compras'],
            'Eventos y Adquisiciones'  => ['Encargado de Adquisiciones', 'Auxiliar de Adquisiciones'],
            'Bodega Médico Quirúrgico' => ['Encargado de Bodega', 'Auxiliar de Bodega'],
            'Bodega de Alimentos'      => ['Encargado de Bodega de Alimentos', 'Auxiliar'],
            'Bodega de Medicamentos'   => ['Encargado de Medicamentos', 'Auxiliar de Medicamentos'],
            'Farmacia Interna'         => ['Farmacéutico/a', 'Auxiliar de Farmacia'],

            // Subdirección Médica
            'Anestesia'                               => ['Médico Anestesiólogo', 'Enfermero/a de Anestesia'],
            'Ginecología y Obstetricia'               => ['Médico Ginecólogo/a', 'Enfermero/a'],
            'Ortopedia y Traumatología'               => ['Médico Ortopedista', 'Auxiliar de Ortopedia'],
            'Cirugía'                                 => ['Médico Cirujano/a', 'Enfermero/a de Cirugía'],
            'Radiología'                              => ['Radiólogo/a', 'Técnico en Radiología'],
            'Medicina Interna'                        => ['Médico Internista', 'Residente'],
            'Pediatría'                               => ['Médico Pediatra', 'Enfermero/a de Pediatría'],
            'Banco de Leche Materna'                  => ['Encargado/a de Banco de Leche', 'Auxiliar'],
            'Odontología'                             => ['Odontólogo/a', 'Asistente Dental'],
            'Terapia Respiratoria'                    => ['Terapeuta Respiratorio/a', 'Auxiliar'],
            'Clínica Integral del Adolescente'        => ['Médico/a', 'Enfermero/a'],
            'Clínica de Violencia Sexual y Maltrato Infantil' => ['Médico/a', 'Psicólogo/a'],
            'Clínica Integral de la Mujer'            => ['Médico/a Ginecólogo/a', 'Enfermero/a'],
            'Unidad de Hemodiálisis'                  => ['Médico Nefrólogo/a', 'Enfermero/a de Hemodiálisis'],

            // Subdirección de Enfermería
            'Cuidados Generales'       => ['Enfermero/a General', 'Auxiliar de Enfermería'],
            'Cuidados Críticos'        => ['Enfermero/a de UCI', 'Auxiliar de UCI'],
            'Salas de Hospitalización' => ['Enfermero/a', 'Auxiliar de Enfermería'],
            'Área Verde'               => ['Enfermero/a', 'Auxiliar'],
            'Intensivos'               => ['Médico Intensivista', 'Enfermero/a de UCI'],
            'Labor y Partos'           => ['Enfermero/a Obstétrico/a', 'Auxiliar'],
            'Emergencia'               => ['Médico de Emergencia', 'Enfermero/a de Emergencia'],
            'Consulta Externa'         => ['Médico/a', 'Enfermero/a de Consulta'],
            'Lactario'                 => ['Encargado/a de Lactario', 'Auxiliar'],
            'Cocina'                   => ['Chef/Cocinero/a', 'Auxiliar de Cocina'],

            // Subdirección Técnica
            'Servicios de Apoyo'                      => ['Coordinador/a de Servicios', 'Auxiliar'],
            'Registros Médicos y Estadística'         => ['Encargado/a de Registros', 'Auxiliar de Estadística'],
            'Trabajo Social'                          => ['Trabajador/a Social', 'Auxiliar'],
            'Atención al Usuario'                     => ['Encargado/a de Atención', 'Auxiliar'],
            'Alimentación y Nutrición'                => ['Nutricionista', 'Auxiliar de Nutrición'],
            'Epidemiología'                           => ['Epidemiólogo/a', 'Auxiliar de Epidemiología'],
            'Auxiliares de Tratamiento'               => ['Auxiliar de Tratamiento'],
            'Unidad de Atención Psicosocial'          => ['Psicólogo/a', 'Trabajador/a Social'],
            'Unidad de Atención Integral (VIH)'       => ['Médico/a', 'Enfermero/a'],
            'Fisioterapia'                            => ['Fisioterapeuta', 'Auxiliar de Fisioterapia'],
            'Auxiliares de Diagnóstico'               => ['Auxiliar de Diagnóstico'],
            'Laboratorio Clínico y Biología Molecular'=> ['Laboratorista', 'Auxiliar de Laboratorio'],
            'Patología'                               => ['Médico Patólogo/a', 'Auxiliar de Patología'],
            'Banco de Sangre'                         => ['Médico Hematólogo/a', 'Auxiliar de Banco de Sangre'],

            // Coordinación de Recursos Humanos
            'Jefe de Personal'         => ['Jefe de Personal'],
            'Secretaría de RRHH'       => ['Secretario/a de RRHH', 'Auxiliar Administrativo/a'],
            'Sección de Dotación'      => ['Encargado/a de Dotación', 'Auxiliar'],
            'Sección de Capacitación'  => ['Encargado/a de Capacitación', 'Instructor/a'],
            'Analista Renglón 011'     => ['Analista de Renglón 011'],
            'Analista de Contratos'    => ['Analista de Contratos'],
            'Sueldos y Salarios'       => ['Encargado/a de Sueldos', 'Auxiliar de Nómina'],
            'Control y Marcaje'        => ['Encargado/a de Control', 'Auxiliar de Marcaje'],

            // Subdirección de Servicios Generales
            'Resguardo y Vigilancia'   => ['Jefe de Seguridad', 'Agente de Seguridad'],
            'Mantenimiento'            => ['Jefe de Mantenimiento', 'Técnico de Mantenimiento', 'Auxiliar de Mantenimiento'],
            'Intendencia'              => ['Encargado/a de Intendencia', 'Auxiliar de Limpieza'],
            'Lavandería'               => ['Encargado/a de Lavandería', 'Auxiliar de Lavandería'],
            'Transportes'              => ['Encargado/a de Transportes', 'Conductor/a'],
            'Imprenta'                 => ['Encargado/a de Imprenta', 'Auxiliar de Imprenta'],
            'Planta Telefónica'        => ['Operador/a Telefónico/a'],
            'Costurería'               => ['Costurero/a', 'Auxiliar de Costurería'],
        ];

        foreach ($positions as $sectionName => $positionNames) {
            $section = Section::where('name', $sectionName)->first();
            if ($section) {
                foreach ($positionNames as $positionName) {
                    Position::firstOrCreate([
                        'name'       => $positionName,
                        'section_id' => $section->id,
                    ]);
                }
            }
        }
    }
}
