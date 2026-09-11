<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subdirection;

class SubdirectionSeeder extends Seeder
{
    public function run(): void
    {
        Subdirection::create(['name' => 'Coordinación de Recursos Humanos']);
    }
}
