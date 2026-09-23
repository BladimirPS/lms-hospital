<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BudgetLine;

class BudgetLineSeeder extends Seeder
{
    public function run(): void
    {
        $budgetLines = [
            ['code' => '011', 'name' => 'Personal permanente'],
            ['code' => '021', 'name' => 'Personal supernumerario'],
            ['code' => '022', 'name' => 'Personal por contrato'],
            ['code' => '029', 'name' => 'Otras remuneraciones de personal temporal'],
            ['code' => '031', 'name' => 'Jornales'],
        ];

        foreach ($budgetLines as $budgetLine) {
            BudgetLine::create($budgetLine);
        }
    }
}
