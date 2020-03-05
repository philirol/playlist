<?php

namespace App\Http\Middleware;

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
        if ($request->user()->leader){ //boolean
            return $next($request);
        }
        return redirect('songs')->with('message', 'Vous n\'avez pas accès à la page demandée et redirigé vers cette page :');
    }
}
