<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotRole
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check() || Auth::user()->role !== $role) {
            if ($role == 'client') {
                return redirect()->route('login.client');
            } elseif ($role == 'admin') {
                return redirect()->route('login.admin');
            }
        }

        return $next($request);
    }
}

