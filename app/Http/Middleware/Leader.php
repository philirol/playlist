<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class Leader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && $request->user()->leader){ //boolean
            return $next($request);
        }
        return redirect('songs')->with('messageDanger', __('Vous n\'avez pas accès à la page demandée'));
    }
}
