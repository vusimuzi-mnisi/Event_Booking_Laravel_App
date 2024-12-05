<?php

// app/Http/Middleware/RoleMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!auth()->check() || auth()->user()->role->name !== $role) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}

