<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tarea;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Support\Testing\Fakes\Fake;

class AdjuntoFactory extends Factory
{
    public function definition(): array
    {
        return [
            //id automatico
            'nombre'=>fake()->name(),
            'url'=>fake()->string(),
            'tarea_id'=>Tarea::all()->random()->id,
        ];
    }
}
