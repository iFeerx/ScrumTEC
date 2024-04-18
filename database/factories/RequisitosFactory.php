<?php    
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Requisito;
use App\Models\Tarea;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Support\Testing\Fakes\Fake;

class RequisitoFactory extends Factory
{
    public function definition(): array
    {
        return [
            //id automatico
            'nombre'=>fake()->name(),
            'tarea_id'=>Tarea::all()->random()->id,
            'requisito_id'=>Requisito::all()->random()->id,
        ];
    }
}
