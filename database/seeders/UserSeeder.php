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
        $section = Section::where('name', 'Sección de Capacitación')->first();
        $position = Position::where('name', 'Encargado de Capacitación')->first();

        User::create([
            'system_code'       => 'SYS-00001',
            'hospital_code'     => 'HGO-001',
            'first_name'        => 'Administrador',
            'last_name'         => 'Sistema',
            'email'             => 'admin@email.com',
            'password'          => Hash::make('Admin1234'),
            'email_verified_at' => now(),
            'section_id'        => $section?->id,
            'position_id'       => $position?->id,
            'active'            => true,
            'hire_date'         => now()->toDateString(),
        ]);
    }
}
