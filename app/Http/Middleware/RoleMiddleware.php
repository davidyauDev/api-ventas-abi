<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role = null)
    {
        if ($role && auth()->check()) {
            if (auth()->user()->role === 'Admin') {
                return $next($request);
            }
            if (auth()->user()->role !== $role) {
                return response()->json(['error' => 'No autorizado'], 403);
            }
        }

        return $next($request);
    }
}
