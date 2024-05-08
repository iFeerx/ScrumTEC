<?php

use App\Http\Controllers\ProyectoController;
use App\Livewire\Historialivewire;
use App\Livewire\ProyectoDetalle;
use App\Livewire\UsuarioLive;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('proyecto/detalle/{id}',[ProyectoController::class,'show']);

Route::get('proyecto',[ProyectoController::class,'administrar']);

Route::get('nuevo-proyecto',[ProyectoController::class,'nuevoProyecto']);

Route::get('proyecto/sprintBoard/{id}',[ProyectoController::class,'sprintBoard']);

Route::get('historia/catalogo',function(){
    return view("historia_catalogo");
});

Route::get('usuarios/catalogo',function(){
    return view("usuarios-catalogo");
});

Route::get('proyecto/{id}',ProyectoDetalle::class);

Route::get('adjuntos',function(){
    return view('archivos-adjuntos');
});
