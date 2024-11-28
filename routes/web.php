<?php

use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\LoginMiddleware;
use App\Livewire\Historialivewire;
use App\Livewire\ProyectoDetalle;
use App\Livewire\UsuarioLive;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

    // Create image
    $background = $captcha_config['backgrounds'][mt_rand(0, count($captcha_config['backgrounds']) - 1)];
    list($bg_width, $bg_height) = getimagesize($background);

    $captcha = imagecreatefrompng($background);

    // Set colors and draw text
    $color = hex2rgb($captcha_config['color']);
    $color = imagecolorallocate($captcha, $color['r'], $color['g'], $color['b']);

    $font = $captcha_config['fonts'][mt_rand(0, count($captcha_config['fonts']) - 1)];
    $font_size = mt_rand($captcha_config['min_font_size'], $captcha_config['max_font_size']);

    // Calculate position and draw text
    $angle = mt_rand($captcha_config['angle_min'], $captcha_config['angle_max']);
    $text_pos_x = 20;  // Simplified positioning
    $text_pos_y = $bg_height - 20;

    imagettftext($captcha, $font_size, $angle, $text_pos_x, $text_pos_y, $color, $font, $captcha_config['code']);

    // Output image
    header('Content-Type: image/png');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    imagepng($captcha);
    imagedestroy($captcha);
    exit();
})->name('captcha');


Route::get('/test-session', function () {
    session(['test_key' => 'test_value']);
    return 'Session data set.';
});

Route::get('/check-session', function () {
    return session('test_key', 'Session data not found.');
});
