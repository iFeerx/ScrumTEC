<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('usuario')) {
            // Ensure user_id is set in the session
            if (!Session::has('user_id')) {
                $usuario = Session::get('usuario');
                $request->session()->put('user_id', $usuario->id);
            }
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}
