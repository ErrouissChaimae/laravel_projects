<?php
namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            // Vérifiez l'URL pour déterminer la redirection appropriée
            if ($request->is('home*') || $request->is('commandes*')) {
                return route('login.client');
            } elseif ($request->is('dashboard*')|| $request->is('tickets*')|| $request->is('autocars*')|| $request->is('commandes.all*')) {
                return route('login.admin');
            }
            
            // Redirection par défaut
            return route('login');
        }
    }
}
