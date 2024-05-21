<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usuario;

class ProyectoFactory extends Factory
{
    public function definition(): array
    {
        return [
            "nombre" => fake()->name(),
            "encargado_id" => Usuario::all()->random()->id,
            "descripcion" => fake()->paragraph(),
        ];
    }
}
