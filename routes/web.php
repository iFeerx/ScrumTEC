<?php

use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\LoginMiddleware;
use App\Livewire\Historialivewire;
use App\Livewire\ProyectoDetalle;
use App\Livewire\UsuarioLive;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

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



Route::get('/captcha', function () {
    // Debug headers
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET');

    $captcha_config = Session::get('_CAPTCHA');

    if (!$captcha_config) {
        Log::error('No captcha config found in session');
        abort(404);
    }

    try {
        // Pick random background
        $background = $captcha_config['backgrounds'][mt_rand(0, count($captcha_config['backgrounds']) - 1)];
        list($bg_width, $bg_height) = getimagesize($background);

        $captcha = imagecreatefrompng($background);

        // Set colors and text properties
        $color = hex2rgb($captcha_config['color']);
        $color = imagecolorallocate($captcha, $color['r'], $color['g'], $color['b']);

        $font = $captcha_config['fonts'][mt_rand(0, count($captcha_config['fonts']) - 1)];
        $font_size = mt_rand($captcha_config['min_font_size'], $captcha_config['max_font_size']);

        // Calculate angle and position
        $angle = mt_rand($captcha_config['angle_min'], $captcha_config['angle_max']);
        $text_box_size = imagettfbbox($font_size, $angle, $font, $captcha_config['code']);

        // Calculate text position
        $box_width = abs($text_box_size[6] - $text_box_size[2]);
        $box_height = abs($text_box_size[5] - $text_box_size[1]);
        $text_pos_x = ($bg_width - $box_width) / 2;
        $text_pos_y = ($bg_height + $box_height) / 2;

        // Draw shadow if enabled
        if ($captcha_config['shadow']) {
            $shadow_color = hex2rgb($captcha_config['shadow_color']);
            $shadow_color = imagecolorallocate($captcha, $shadow_color['r'], $shadow_color['g'], $shadow_color['b']);
            imagettftext(
                $captcha,
                $font_size,
                $angle,
                $text_pos_x + $captcha_config['shadow_offset_x'],
                $text_pos_y + $captcha_config['shadow_offset_y'],
                $shadow_color,
                $font,
                $captcha_config['code']
            );
        }

        // Draw main text
        imagettftext($captcha, $font_size, $angle, $text_pos_x, $text_pos_y, $color, $font, $captcha_config['code']);

        // Set headers and output image
        header('Content-Type: image/png');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');

        imagepng($captcha);
        imagedestroy($captcha);
        exit();

    } catch (\Exception $e) {
        Log::error('Captcha generation failed: ' . $e->getMessage());
        abort(500);
    }
})->middleware(['web'])->name('captcha');


Route::get('/test-session', function () {
    session(['test_key' => 'test_value']);
    return 'Session data set.';
});

Route::get('/check-session', function () {
    return session('test_key', 'Session data not found.');
});
