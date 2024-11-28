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
    // Force HTTPS for image URL
    if (!request()->secure() && env('APP_ENV') === 'production') {
        return redirect()->secure(request()->getRequestUri());
    }

    $captcha_config = Session::get('_CAPTCHA');
    if (!$captcha_config) {
        Log::error('No captcha config found in session');
        abort(404);
    }

    try {
        $background = $captcha_config['backgrounds'][mt_rand(0, count($captcha_config['backgrounds']) - 1)];

        // Verify file exists and is readable
        if (!is_readable($background)) {
            Log::error("Cannot read background file: $background");
            abort(500);
        }

        $captcha = imagecreatefrompng($background);
        if (!$captcha) {
            Log::error("Failed to create image");
            abort(500);
        }

        // Clear any previous output
        ob_clean();

        // Set headers
        header('Content-Type: image/png');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');

        // Output image
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
