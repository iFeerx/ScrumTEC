<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use App\Models\Usuario;

class ProyectoController extends Controller
{
    public function show($id)
    {
        $proyecto = Proyecto::find($id);
        return view('detalles-proyecto', ['id' => $id]);
    }

    public function administrar()
    {
        return view('mostrar_proyectos');
    }

    public function sprintBoard($id)
    {
        $proyecto = Proyecto::find($id);
        return view('sprint_board', ['proyecto' => $proyecto]);
    }

    public function nuevoProyecto()
    {
        return view('agregar-proyectos');
    }

    //METODO PARA EL CALENDARIO
    // OBTIENE A LOS USUARIOS
    // ENCODER,REVIEWER,TESTER
    public function obtenerUser()
    {   // OBTENER TAREAS DEL USUARIO PARA CADA TIPO
        $usuarios_encoder = Usuario::whereHas('tareasEncoder', function ($query) {
            $query->where('estatus', 'terminado')
                ->whereNotNull('encoder_date')
                ->whereNotNull('encoding_finish_date');
        })->with(['tareasEncoder'])->get();
        $usuarios_reviewer = Usuario::whereHas('tareasReviewer', function ($query) {
            $query->where('estatus', 'terminado')
                ->whereNotNull('reviewer_date')
                ->whereNotNull('reviewer_finish_date');
        })->with(['tareasReviewer'])->get();
        $usuarios_tester = Usuario::whereHas('tareasTester', function ($query) {
            $query->where('estatus', 'terminado')
                ->whereNotNull('tester_date')
                ->whereNotNull('tester_finish_date');
        })->with(['tareasTester'])->get();
            //los retornamos a la vista calendario
        return view('calendario', compact('usuarios_encoder', 'usuarios_reviewer', 'usuarios_tester'));
    }
}
