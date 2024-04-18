<?php     //seeder ROLES

namespace Database\Seeders;

use App\Models\Proyecto;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = Usuario::all();
        $roles = [
            "Product owner" => [$usuarios[0]],
            "Scrum master" => [$usuarios[1]],
            "Team leader" => [$usuarios[2],$usuarios[3]],
            "Developer" => [$usuarios[2],$usuarios[3],$usuarios[4],
                        $usuarios[5],$usuarios[6],$usuarios[7],
                        $usuarios[8],$usuarios[9]],
            "Reviewer" => [$usuarios[4],$usuarios[5]],
            "Tester" => [$usuarios[5],$usuarios[6]]
        ];
        $proyectos = Proyecto::all();
        foreach ($proyectos as $proyecto) {
            foreach ($roles as $tiporol => $usuarios) {
                foreach ($usuarios as $usuario) {
                    $rol = new Rol();
                    $rol->rol = $tiporol;
                    $rol->proyecto_id = $proyecto->id;
                    $rol->usuario_id = $usuario->id;
                    $rol->save();
                }
            }
        }
    }
}
