<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthoritationAdmin
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
        if (!Auth::check()) {
            return redirect()->route('admin-login')->with('error', 'Debe iniciar sesión como administrador.');
        }
    
        if (Auth::user()->rol === 'admin') {
            return $next($request);
        }
    
        return redirect()->route('admin-login')->with('error', 'Acceso no autorizado.');
    }
    
}
