<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{

    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::guard('employee')->check()) {
            return redirect('login');
        }

        $user = Auth::guard('employee')->user();

        if ($user->role !== $role) {
            return redirect()->route('dashboard')->with('error', "Anda tidak memiliki akses ke halaman ini.");
        }

        return $next($request);
    }
}
