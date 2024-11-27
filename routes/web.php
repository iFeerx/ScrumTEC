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

    header("Content-Type: image/png");

    // Function to convert hex color to RGB
    if (!function_exists('hex2rgb')) {
        function hex2rgb($hex_str, $return_string = false, $separator = ',') {
            $hex_str = preg_replace("/[^0-9A-Fa-f]/", '', $hex_str);
            $rgb_array = array();
            if (strlen($hex_str) == 6) {
                $color_val = hexdec($hex_str);
                $rgb_array['r'] = 0xFF & ($color_val >> 0x10);
                $rgb_array['g'] = 0xFF & ($color_val >> 0x8);
                $rgb_array['b'] = 0xFF & $color_val;
            } elseif (strlen($hex_str) == 3) {
                $rgb_array['r'] = hexdec(str_repeat(substr($hex_str, 0, 1), 2));
                $rgb_array['g'] = hexdec(str_repeat(substr($hex_str, 1, 1), 2));
                $rgb_array['b'] = hexdec(str_repeat(substr($hex_str, 2, 1), 2));
            } else {
                return false;
            }
            return $return_string ? implode($separator, $rgb_array) : $rgb_array;
        }
    }

    // Generate captcha image
    // Use the code from simple-php-captcha.php adapted for Laravel

    // Pick random background
    $background = $captcha_config['backgrounds'][mt_rand(0, count($captcha_config['backgrounds']) - 1)];
    list($bg_width, $bg_height) = getimagesize($background);

    $captcha = imagecreatefrompng($background);

    // Allocate text color
    $color = hex2rgb($captcha_config['color']);
    $color = imagecolorallocate($captcha, $color['r'], $color['g'], $color['b']);

    // Determine text angle
    $angle = mt_rand($captcha_config['angle_min'], $captcha_config['angle_max']);
    $angle = ($angle * (mt_rand(0, 1) == 1 ? -1 : 1));

    // Select font randomly
    $font = $captcha_config['fonts'][mt_rand(0, count($captcha_config['fonts']) - 1)];

    // Verify font file exists
    if (!file_exists($font)) {
        throw new Exception('Font file not found: ' . $font);
    }

    // Set font size
    $font_size = mt_rand($captcha_config['min_font_size'], $captcha_config['max_font_size']);
    $text_box_size = imagettfbbox($font_size, $angle, $font, $captcha_config['code']);

    // Determine text position
    $box_width = abs($text_box_size[6] - $text_box_size[2]);
    $box_height = abs($text_box_size[5] - $text_box_size[1]);
    $text_pos_x = mt_rand(0, $bg_width - $box_width);
    $text_pos_y = mt_rand($box_height, $bg_height - ($box_height / 2));

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

    // Draw text
    imagettftext($captcha, $font_size, $angle, $text_pos_x, $text_pos_y, $color, $font, $captcha_config['code']);

    // Output image
    imagepng($captcha);
    imagedestroy($captcha);
    exit();
});
