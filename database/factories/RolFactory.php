<?php    
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Proyecto;
use App\Models\Usuario;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Support\Testing\Fakes\Fake;

class RolFactory extends Factory
{
    public function definition(): array
    {
        return [
            //id automatico
            'nombre'=>fake()->name(),
            'proyecto_id'=>Proyecto::all()->random()->id,
            'usuario_id'=>Usuario::all()->random()->id,
        ];
    }
}
