<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;

class CheckUserRole
{

    public function handle($request, Closure $next, $role)
    {  
           // Verifica si el usuario está autenticado
            if (!$request->user()) {
                return response()->json(['message' => 'No autorizado. Por favor, inicie sesión.'], 401);
            }
        
            // Verifica si el usuario tiene el rol requerido
            if (!$request->user()->hasRole($role)) {
                return response()->json(['message' => 'No tiene permisos para acceder a este recurso.'], 403);
            }
        
            return $next($request);
    }
}
