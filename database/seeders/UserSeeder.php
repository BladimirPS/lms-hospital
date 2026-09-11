<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Section;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $section = Section::where('name', 'Capacitación')->first();

        User::create([
            'system_code'       => 'SYS-00001',
            'hospital_code'     => 'HGO-001',
            'first_name'        => 'Administrador',
            'last_name'         => 'Sistema',
            'email'             => 'admin@email.com',
            'password'          => Hash::make('admin1234'),
            'email_verified_at' => now(),
            'section_id'        => $section->id,
            'active'            => true,
            'hire_date'         => now()->toDateString(),
            'position'          => 'Administrador del Sistema',
        ]);
    }
}
