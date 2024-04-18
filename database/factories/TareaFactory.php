<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usuario;
use App\Models\Historia;

class TareaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'historia_id' => Historia::all()->random()->id,
            'nombre' => fake()->words(3,true),
            'descripcion' => fake()->text($maxNbChars = 350),
            'entregables' => fake()->text($maxNbChars = 200),
            'esfuerzo_estimado' => fake()->numberBetween(1, 100),
            'esfuerzo_real' => fake()->numberBetween(1, 100),
            'sprint' => fake()->numberBetween(0, 10),
            'encoder_id' => Usuario::all()->random()->id,
            'reviewer_id' => Usuario::all()->random()->id,
            'tester_id' => Usuario::all()->random()->id,
            'encoder_date' => fake()->date(),
            'reviewer_date' => fake()->date(),
            'tester_date' => fake()->date(),
            'encoding_finish_date' => fake()->date(),
            'reviewer_finish_date' => fake()->date(),
            'tester_finish_date' => fake()->date(),
            'comentarios' => fake()->paragraph(),
            'estatus' => fake()->randomElement(['espera', 'codificando', 'revisando', 'probando', 'terminado', 'corrigiendo', 'codificado', 'revisado', 'probado', 'atascado']),
        ];
    }
}
