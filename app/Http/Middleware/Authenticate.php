<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\RedirectResponse;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *Ce middleware permet de savoir si un utilisateur n'est pas authentifié

     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
            // return '/user/profil';
        }
    }
}
