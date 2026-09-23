<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar cache de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear los tres roles
        Role::create(['name' => 'superadmin']);
        Role::create(['name' => 'encargado']);
        Role::create(['name' => 'estudiante']);


    }
}
