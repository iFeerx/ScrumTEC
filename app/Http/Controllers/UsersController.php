<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function vistaLogin()
    {
        include("simple-php-captcha-master/simple-php-captcha.php");
        $captcha = simple_php_captcha();
        Session::put('captcha.code', $captcha['code']);

        $proyectos = Proyecto::latest()->take(5)->get();
        return view('login', [
            'proyectos' => $proyectos,
            'captcha' => $captcha
        ]);
    }

    public function login(Request $request)
    {
        // Debugging: Log the request data
        Log::info('Login attempt:', $request->all());

        if (Session::get('captcha.code') != $request->captcha) {
            return back()->with('error', 'Captcha incorrecto');
        }

        $usuario = Usuario::where('email', $request->email)->first();
        if ($usuario && Hash::check($request->password, $usuario->password)) {
            Session::put('usuario', $usuario);
            $request->session()->put('user_id', $usuario->id);
            return redirect('/proyecto');
        }
        return back()->with('error', 'Correo o contraseña incorrectos');
    }

    public function logout(Request $request)
    {
        // Elimina la sesión del usuario
        $request->session()->forget('usuario');
        $request->session()->forget('user_id');

        // Redirige al usuario a la página de inicio de sesión u otra página deseada
        return redirect('/');
    }

    public function login2($correo, $password)
    {
        $usuario = Usuario::where('email', $correo)->first();
        if ($usuario && Hash::check($password, $usuario->password)) {
            return 'Ok';
        }
        return 'No';
    }
}
