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
    try {
        $captcha_config = Session::get('_CAPTCHA');
        if (!$captcha_config) {
            Log::error('No captcha config found in session');
            return response('Captcha config not found', 404);
        }

        // Get random background
        $background = $captcha_config['backgrounds'][array_rand($captcha_config['backgrounds'])];

        if (!file_exists($background)) {
            Log::error("Background file not found: $background");
            return response('Background not found', 404);
        }

        // Create image
        $captcha = imagecreatefrompng($background);

        // Set colors
        $color = hex2rgb($captcha_config['color']);
        $color = imagecolorallocate($captcha, $color['r'], $color['g'], $color['b']);

        // Add text
        $font = $captcha_config['fonts'][array_rand($captcha_config['fonts'])];
        $font_size = 28;
        imagettftext($captcha, $font_size, 0, 10, 30, $color, $font, $captcha_config['code']);

        Log::info('Background path:', ['path' => $background]);
        Log::info('Font path:', ['path' => $font]);

        // Output image
        return response()->stream(
            function () use ($captcha) {
                imagepng($captcha);
                imagedestroy($captcha);
            },
            200,
            ['Content-Type' => 'image/png']
        );
    } catch (\Exception $e) {
        Log::error('Captcha error: ' . $e->getMessage());
        return response('Error generating captcha', 500);
    }
})->middleware('web')->name('captcha');

Route::get('/test-session', function () {
    session(['test_key' => 'test_value']);
    return 'Session data set.';
});

Route::get('/check-session', function () {
    return session('test_key', 'Session data not found.');
});


function hex2rgb($hex)
{
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    return ['r' => $r, 'g' => $g, 'b' => $b];
}
