<?php
//
//  A simple PHP CAPTCHA script
//
//  Copyright 2011 by Cory LaViska for A Beautiful Site, LLC
//
//  See readme.md for usage, demo, and licensing info
//

use Illuminate\Support\Facades\Session;

function simple_php_captcha($config = array())
{

    // Check for GD library
    if (!function_exists('gd_info')) {
        throw new Exception('Required GD library is missing');
    }

    $bg_path = public_path('captcha/backgrounds/');
    $font_path = public_path('captcha/fonts/');

    // Default values
    $captcha_config = array(
        'code' => '',
        'min_length' => 5,
        'max_length' => 5,
        'backgrounds' => array(
            $bg_path . '45-degree-fabric.png',
            $bg_path . 'cloth-alike.png',
            $bg_path . 'grey-sandbag.png',
            $bg_path . 'kinda-jean.png',
            $bg_path . 'polyester-lite.png',
            $bg_path . 'stitched-wool.png',
            $bg_path . 'white-carbon.png',
            $bg_path . 'white-wave.png'
        ),
        'fonts' => array(
            $font_path . 'times_new_yorker.ttf'
        ),
        'characters' => 'ABCDEFGHJKLMNPRSTUVWXYZabcdefghjkmnprstuvwxyz23456789',
        'min_font_size' => 28,
        'max_font_size' => 28,
        'color' => '#666',
        'angle_min' => 0,
        'angle_max' => 10,
        'shadow' => true,
        'shadow_color' => '#fff',
        'shadow_offset_x' => -1,
        'shadow_offset_y' => 1
    );

    // Store the captcha configuration in Laravel's session
    Session::put('_CAPTCHA', $captcha_config);
    
    // Merge custom configurations
    if (is_array($config)) {
        $captcha_config = array_merge($captcha_config, $config);
    }

    // Generate the captcha code
    if (empty($captcha_config['code'])) {
        $length = mt_rand($captcha_config['min_length'], $captcha_config['max_length']);
        $captcha_config['code'] = '';
        while (strlen($captcha_config['code']) < $length) {
            $captcha_config['code'] .= substr($captcha_config['characters'], mt_rand() % (strlen($captcha_config['characters'])), 1);
        }
    }

    // Store the captcha configuration in Laravel's session
    Session::put('_CAPTCHA', $captcha_config);

    // Generate the image source URL
    $captcha_config['image_src'] = url('/captcha') . '?t=' . urlencode(microtime());

    return array(
        'code' => $captcha_config['code'],
        'image_src' => $captcha_config['image_src'],
    );
}
