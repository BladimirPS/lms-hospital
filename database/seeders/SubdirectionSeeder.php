<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subdirection;

class SubdirectionSeeder extends Seeder
{
    public function run(): void
    {
        $subdirections = [
            ['name' => 'Subdirección Administrativa Financiera'],
            ['name' => 'Subdirección Médica'],
            ['name' => 'Subdirección de Enfermería'],
            ['name' => 'Subdirección Técnica'],
            ['name' => 'Coordinación de Recursos Humanos'],
            ['name' => 'Subdirección de Servicios Generales'],
        ];

        foreach ($subdirections as $subdirection) {
            Subdirection::create($subdirection);
        }
    }
}
