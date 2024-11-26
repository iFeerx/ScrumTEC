<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function vistaLogin()
    {
        
        include("simple-php-captcha-master/simple-php-captcha.php");
        $captcha = simple_php_captcha();
        $_SESSION['captcha'] = $captcha;
        Session::put('captcha', $captcha); // Store captcha in Laravel session
        $proyectos = Proyecto::latest()->take(5)->get(); // Obtén los últimos 5 proyectos
        return view('login', ['proyectos' => $proyectos, 'captcha' => $captcha]); // Pasa los proyectos a la vista
    }

    public function login(Request $request)
    {
        session_start();
        if ($_SESSION['captcha']['code'] != $request->captcha) {
            Session::flash("error", "Captcha incorrecto");
            return back()->with('error', 'Captcha incorrecto');
        }

        $usuario = Usuario::where('email', $request->email)->first();
        if ($usuario && Hash::check($request->password, $usuario->password)) {
            Session::put('usuario', $usuario);
            // Manually set the user_id in the session
            $request->session()->put('user_id', $usuario->id);
            return redirect('/proyecto');
        }
        Session::flash("error", "Correo o contraseña incorrectos");
        return back()->with('error', 'Correo o contraseña incorrectos');
    }

    public function logout(Request $request)
    {
        // Elimina la sesión del usuario
        $request->session()->forget('usuario');

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
