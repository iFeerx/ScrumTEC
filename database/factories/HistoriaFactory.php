<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Proyecto;
use App\Models\Historia;

class HistoriaFactory extends Factory
{
    public function definition(): array
    {
        return [
            "nombre" => fake()->name(),
            "proyecto_id" => Proyecto::all()->random()->id,
            "historia" => fake()->paragraph(),
        ];
    }
}
