<?php

namespace Database\Seeders;

use App\Models\Requisito;
use Illuminate\Database\Seeder;

class RequisitosSeeder extends Seeder
{
    public function run(): void
    {
        Requisito::factory()
        ->count(100)
        ->create();
    }
}
