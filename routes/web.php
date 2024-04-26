<?php

use App\Http\Controllers\ProyectoController;
use App\Livewire\Historialivewire;
use App\Livewire\ProyectoDetalle;
use App\Livewire\UsuarioLive;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
