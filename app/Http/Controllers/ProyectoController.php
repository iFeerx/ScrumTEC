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
}
