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



Route::get('/captchaa', function () {
    try {
        $captcha_config = Session::get('_CAPTCHA');
        if (!$captcha_config) {
            Log::error('No captcha config in session');
            return response('No captcha config', 404);
        }

        $background = $captcha_config['backgrounds'][array_rand($captcha_config['backgrounds'])];

        return response()->stream(
            function () use ($background, $captcha_config) {
                $image = imagecreatefrompng($background);
                $color = hex2rgb($captcha_config['color']);
                $text_color = imagecolorallocate($image, $color['r'], $color['g'], $color['b']);

                $font = $captcha_config['fonts'][0];
                imagettftext(
                    $image,
                    $captcha_config['min_font_size'],
                    0,
                    10,
                    30,
                    $text_color,
                    $font,
                    $captcha_config['code']
                );

                imagepng($image);
                imagedestroy($image);
            },
            200,
            [
                'Content-Type' => 'image/png',
                'Cache-Control' => 'no-cache, no-store, must-revalidate'
            ]
        );
    } catch (\Exception $e) {
        Log::error($e);
        return response($e->getMessage(), 500);
    }
})->middleware('web')->name('captcha.image');

Route::get('/test-session', function () {
    session(['test_key' => 'test_value']);
    return 'Session data set.';
});

Route::get('/check-session', function () {
    return session('test_key', 'Session data not found.');
});

Route::get('/test-captcha-path', function () {
    $bg_path = public_path('captcha/backgrounds/');
    return [
        'bg_path_exists' => is_dir($bg_path),
        'bg_path' => $bg_path,
        'files' => is_dir($bg_path) ? scandir($bg_path) : [],
        'permissions' => decoct(fileperms($bg_path) & 0777)
    ];
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
