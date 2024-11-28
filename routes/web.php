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
    // Add debugging at start
    Log::info('Captcha route hit');
    Log::info('Session data:', ['captcha' => Session::get('_CAPTCHA')]);

    try {
        $captcha_config = Session::get('_CAPTCHA');

        // Debug captcha config
        Log::info('Config:', ['config' => $captcha_config]);

        if (!$captcha_config) {
            Log::error('No captcha config found in session');
            return response('Captcha config not found', 404);
        }

        $background = $captcha_config['backgrounds'][array_rand($captcha_config['backgrounds'])];

        // Debug file path
        Log::info('Background path:', ['path' => $background, 'exists' => file_exists($background)]);

        if (!file_exists($background)) {
            Log::error("Background file not found: $background");
            return response('Background not found', 404);
        }

        // Output headers for debugging
        header('Content-Type: image/png');
        header('Cache-Control: no-cache, must-revalidate');
        header('Access-Control-Allow-Origin: *');

        $captcha = imagecreatefrompng($background);
        if (!$captcha) {
            Log::error('Failed to create image');
            return response('Image creation failed', 500);
        }

        ob_start();
        imagepng($captcha);
        $image_data = ob_get_clean();
        imagedestroy($captcha);

        return response($image_data)
            ->header('Content-Type', 'image/png')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    } catch (\Exception $e) {
        Log::error('Captcha error: ' . $e->getMessage());
        Log::error('Stack trace: ' . $e->getTraceAsString());
        return response('Error generating captcha: ' . $e->getMessage(), 500);
    }
})->middleware(['web'])->withoutMiddleware([\App\Http\Middleware\VerifyCSRFToken::class])->name('captcha');

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
