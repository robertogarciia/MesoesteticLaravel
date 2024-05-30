<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
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
        // Verificar si el usuario actual es un administrador
        if ($request->user() && strpos($request->user()->post, '1') !== false) {
            return $next($request);
        }

        // Si no es un administrador, redirigir o mostrar un mensaje de error
        return redirect('/dashboard')->with('error', 'No tienes permisos de administrador.');
    }
}
