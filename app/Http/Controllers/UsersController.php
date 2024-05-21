<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Usuario;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function vistaLogin()
    {
        $proyectos = Proyecto::latest()->take(5)->get(); // Obtén los últimos 5 proyectos
        return view('login', ['proyectos' => $proyectos]); // Pasa los proyectos a la vista
    }

    public function login(Request $request)
    {
        $usuario = Usuario::where('email',$request->email)->get()->first();
        if ($usuario &&
            Hash::check($request->password,$usuario->password))
        {
            Session::put('usuario',$usuario);
            return redirect('/proyecto');
        }
        Session::flash("error","Correo o contraseña incorrectos");
        return back()->with('error', 'Correo o contraseña incorrectos');
    }

    public function logout(Request $request)
    {
    // Elimina la sesión del usuario
    $request->session()->forget('usuario');

    // Redirige al usuario a la página de inicio de sesión u otra página deseada
    return redirect('/login');
    }
}
