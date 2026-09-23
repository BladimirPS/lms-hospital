<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Section;
use App\Models\Position;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
     public function run(): void
    {
        $users = [
            // 2 Superadmin
            [
                'first_name'  => 'Administrador',
                'last_name'   => 'Sistema',
                'email'       => 'admin@email.com',
                'section'     => 'Sección de Capacitación',
                'position'    => 'Encargado/a de Capacitación',
                'role'        => 'superadmin',
                'hospital_code' => 'HGO-001',
            ],
            [
                'first_name'  => 'María',
                'last_name'   => 'López',
                'email'       => 'maria.lopez@hgo.gob.gt',
                'section'     => 'Jefe de Personal',
                'position'    => 'Jefe de Personal',
                'role'        => 'superadmin',
                'hospital_code' => 'HGO-002',
            ],

            // 3 Encargados
            [
                'first_name'  => 'Carlos',
                'last_name'   => 'Méndez',
                'email'       => 'carlos.mendez@hgo.gob.gt',
                'section'     => 'Cirugía',
                'position'    => 'Médico Cirujano/a',
                'role'        => 'encargado',
                'hospital_code' => 'HGO-003',
            ],
            [
                'first_name'  => 'Ana',
                'last_name'   => 'García',
                'email'       => 'ana.garcia@hgo.gob.gt',
                'section'     => 'Emergencia',
                'position'    => 'Médico de Emergencia',
                'role'        => 'encargado',
                'hospital_code' => 'HGO-004',
            ],
            [
                'first_name'  => 'Luis',
                'last_name'   => 'Pérez',
                'email'       => 'luis.perez@hgo.gob.gt',
                'section'     => 'Mantenimiento',
                'position'    => 'Jefe de Mantenimiento',
                'role'        => 'encargado',
                'hospital_code' => 'HGO-005',
            ],

            // 15 Estudiantes
            [
                'first_name'  => 'Pedro',
                'last_name'   => 'Mendez',
                'email'       => 'pedro.mendez@hgo.gob.gt',
                'section'     => 'Anestesia',
                'position'    => 'Médico Anestesiólogo',
                'role'        => 'estudiante',
                'hospital_code' => 'HGO-006',
            ],
            [
                'first_name'  => 'Rosa',
                'last_name'   => 'Ajanel',
                'email'       => 'rosa.ajanel@hgo.gob.gt',
                'section'     => 'Cuidados Generales',
                'position'    => 'Enfermero/a General',
                'role'        => 'estudiante',
                'hospital_code' => 'HGO-007',
            ],
            [
                'first_name'  => 'Juan',
                'last_name'   => 'Morales',
                'email'       => 'juan.morales@hgo.gob.gt',
                'section'     => 'Radiología',
                'position'    => 'Técnico en Radiología',
                'role'        => 'estudiante',
                'hospital_code' => 'HGO-008',
            ],
            [
                'first_name'  => 'Lucia',
                'last_name'   => 'Ramírez',
                'email'       => 'lucia.ramirez@hgo.gob.gt',
                'section'     => 'Pediatría',
                'position'    => 'Enfermero/a de Pediatría',
                'role'        => 'estudiante',
                'hospital_code' => 'HGO-009',
            ],
            [
                'first_name'  => 'Miguel',
                'last_name'   => 'Hernández',
                'email'       => 'miguel.hernandez@hgo.gob.gt',
                'section'     => 'Farmacia Interna',
                'position'    => 'Auxiliar de Farmacia',
                'role'        => 'estudiante',
                'hospital_code' => 'HGO-010',
            ],
            [
                'first_name'  => 'Sandra',
                'last_name'   => 'López',
                'email'       => 'sandra.lopez@hgo.gob.gt',
                'section'     => 'Trabajo Social',
                'position'    => 'Trabajador/a Social',
                'role'        => 'estudiante',
                'hospital_code' => 'HGO-011',
            ],
            [
                'first_name'  => 'Diego',
                'last_name'   => 'Castillo',
                'email'       => 'diego.castillo@hgo.gob.gt',
                'section'     => 'Mantenimiento',
                'position'    => 'Técnico de Mantenimiento',
                'role'        => 'estudiante',
                'hospital_code' => 'HGO-012',
            ],
            [
                'first_name'  => 'Elena',
                'last_name'   => 'Vásquez',
                'email'       => 'elena.vasquez@hgo.gob.gt',
                'section'     => 'Contabilidad',
                'position'    => 'Auxiliar de Contabilidad',
                'role'        => 'estudiante',
                'hospital_code' => 'HGO-013',
            ],
            [
                'first_name'  => 'Fernando',
                'last_name'   => 'Cruz',
                'email'       => 'fernando.cruz@hgo.gob.gt',
                'section'     => 'Laboratorio Clínico y Biología Molecular',
                'position'    => 'Laboratorista',
                'role'        => 'estudiante',
                'hospital_code' => 'HGO-014',
            ],
            [
                'first_name'  => 'Gloria',
                'last_name'   => 'Xicará',
                'email'       => 'gloria.xicara@hgo.gob.gt',
                'section'     => 'Lavandería',
                'position'    => 'Auxiliar de Lavandería',
                'role'        => 'estudiante',
                'hospital_code' => 'HGO-015',
            ],
            [
                'first_name'  => 'Héctor',
                'last_name'   => 'Tahay',
                'email'       => 'hector.tahay@hgo.gob.gt',
                'section'     => 'Fisioterapia',
                'position'    => 'Fisioterapeuta',
                'role'        => 'estudiante',
                'hospital_code' => 'HGO-016',
            ],
            [
                'first_name'  => 'Irma',
                'last_name'   => 'Batz',
                'email'       => 'irma.batz@hgo.gob.gt',
                'section'     => 'Cocina',
                'position'    => 'Auxiliar de Cocina',
                'role'        => 'estudiante',
                'hospital_code' => 'HGO-017',
            ],
            [
                'first_name'  => 'Jorge',
                'last_name'   => 'Cux',
                'email'       => 'jorge.cux@hgo.gob.gt',
                'section'     => 'Emergencia',
                'position'    => 'Enfermero/a de Emergencia',
                'role'        => 'estudiante',
                'hospital_code' => 'HGO-018',
            ],
            [
                'first_name'  => 'Karen',
                'last_name'   => 'Ixchop',
                'email'       => 'karen.ixchop@hgo.gob.gt',
                'section'     => 'Intendencia',
                'position'    => 'Auxiliar de Limpieza',
                'role'        => 'estudiante',
                'hospital_code' => 'HGO-019',
            ],
            [
                'first_name'  => 'Manuel',
                'last_name'   => 'Ajú',
                'email'       => 'manuel.aju@hgo.gob.gt',
                'section'     => 'Transportes',
                'position'    => 'Conductor/a',
                'role'        => 'estudiante',
                'hospital_code' => 'HGO-020',
            ],
        ];

        foreach ($users as $index => $data) {
            $section  = Section::where('name', $data['section'])->first();
            $position = Position::where('name', $data['position'])
                ->where('section_id', $section?->id)
                ->first();

            $user = User::create([
                'system_code'       => 'SYS-' . str_pad($index + 1, 5, '0', STR_PAD_LEFT),
                'hospital_code'     => $data['hospital_code'],
                'first_name'        => $data['first_name'],
                'last_name'         => $data['last_name'],
                'email'             => $data['email'],
                'password'          => Hash::make('admin1234'),
                'email_verified_at' => now(),
                'section_id'        => $section?->id,
                'position_id'       => $position?->id,
                'active'            => true,
                'hire_date'         => now()->toDateString(),
            ]);

            $user->assignRole($data['role']);
        }
    }
}
