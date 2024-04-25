<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function show($id)
    {
        $proyecto = Proyecto::find($id);
        return view('detalles-proyecto', ['proyecto' => $proyecto]);
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
}
