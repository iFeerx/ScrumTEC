<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Proyecto;
use App\Models\Usuario;

class ProyectoFactory extends Factory
{
    public function definition(): array
    {
        return [
            "nombre" => fake()->name(),
            "descripcion" => fake()->paragraph(),
        ];
    }
}
