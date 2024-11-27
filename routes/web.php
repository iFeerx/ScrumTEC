<?php

use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\LoginMiddleware;
use App\Livewire\Historialivewire;
use App\Livewire\ProyectoDetalle;
use App\Livewire\UsuarioLive;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->controller(UsersController::class)->group(function () {
    Route::get('', 'vistaLogin');
    Route::post('login', 'login');
    Route::get('logout', 'logout');
});

Route::get('login/{correo}/{password}', [UsersController::class, 'login2']);

Route::middleware([LoginMiddleware::class])->group(function () {
    // Rutas protegidas que requieren inicio de sesión
    Route::get('proyecto/detalle/{id}', [ProyectoController::class, 'show']);
    Route::get('proyecto', [ProyectoController::class, 'administrar']);
    Route::get('nuevo-proyecto', [ProyectoController::class, 'nuevoProyecto']);
    Route::get('proyecto/sprintBoard/{id}', [ProyectoController::class, 'sprintBoard']);
    Route::get('proyecto/{id}', ProyectoDetalle::class);
    Route::get('usuarios/catalogo', function () {
        return view("usuarios-catalogo");
    });
    Route::get('historia/catalogo', function () {
        return view("historia_catalogo");
    });
    Route::get('adjuntos', function () {
        return view('archivos-adjuntos');
    });
});


Route::get('/captcha', function() {
    $captcha_config = Session::get('_CAPTCHA');

    if (!$captcha_config) {
        abort(404);
    }

    header("Content-Type: image/png");

    $width = $captcha_config['width'];
    $height = $captcha_config['height'];
    $code = $captcha_config['code'];

    // Create the image resource
    $image = imagecreatetruecolor($width, $height);

    // Allocate colors and set up the image
    // ... (your existing image creation code)
    // For example:
    $background_color = imagecolorallocate($image, 255, 255, 255); // white background
    imagefilledrectangle($image, 0, 0, $width, $height, $background_color);

    // Add the text to the image
    $text_color = imagecolorallocate($image, 0, 0, 0); // black text
    $font_size = 20;
    $font = '/path/to/font.ttf'; // Update with the correct path
    imagettftext($image, $font_size, 0, 10, 30, $text_color, $font, $code);

    // Output the image
    imagepng($image);
    imagedestroy($image);
    exit();
});
