<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run(): void
    {
       $user = \App\Models\User::updateOrCreate(
            ['email' => 'bladimir@gmail.com'],
            [
                'system_code' => 'ADMIN-001',
                'first_name' => 'Bladimir',
                'last_name' => 'Administrador',
                'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
                'email_verified_at' => now(),
                'active' => true,
            ]
        );

        if (method_exists($user, 'assignRole')) {
            $user->assignRole('super_admin');
        }
    }
}
