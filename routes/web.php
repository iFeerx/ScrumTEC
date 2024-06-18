<?php

use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\LoginMiddleware;
use App\Livewire\Historialivewire;
use App\Livewire\ProyectoDetalle;
use App\Livewire\UsuarioLive;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->controller(UsersController::class)->group(function(){
    Route::get('','vistaLogin');
    Route::post('login','login');
});

Route::get('login/{correo}/{password}',[UsersController::class,'login2']);



Route::middleware([LoginMiddleware::class])->group(function () {
    // Rutas protegidas que requieren inicio de sesión
    Route::get('proyecto/detalle/{id}', [ProyectoController::class,'show']);
    Route::get('proyecto', [ProyectoController::class,'administrar']);
    Route::get('nuevo-proyecto', [ProyectoController::class,'nuevoProyecto']);
    Route::get('proyecto/sprintBoard/{id}', [ProyectoController::class,'sprintBoard']);
    Route::get('proyecto/{id}', ProyectoDetalle::class);
    Route::get('usuarios/catalogo', function () {
        return view("usuarios-catalogo");
    });
    Route::get('historia/catalogo',function(){
        return view("historia_catalogo");
    });
    Route::get('adjuntos',function(){
        return view('archivos-adjuntos');
    });
});

