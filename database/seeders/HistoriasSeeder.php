<?php

namespace Database\Seeders;

use App\Models\Historia;
use App\Models\Proyecto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HistoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proyectos = Proyecto::all();
        foreach ($proyectos as $proyecto) {
            $historias = Historia::factory()->count(10)->make();
            foreach ($historias as $historia) {
                $historia->proyecto_id = $proyecto->id;
                $historia->save();
            }
        }
    }
}
