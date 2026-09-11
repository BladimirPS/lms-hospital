<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\Subdirection;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        $rrhh = Subdirection::where('name', 'Coordinación de Recursos Humanos')->first();

        Section::create([
            'name'             => 'Capacitación',
            'subdirection_id'  => $rrhh->id,
        ]);
    }
}
