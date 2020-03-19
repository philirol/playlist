<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Userville
{
    // Middleware not effective (control on ville not implemented in Kernel)



    public function handle($request, Closure $next)
    {
        if ($request->user()->band->ville == null ){ //admin boolean
            return redirect('songs')->with('message', 'Vous n\'avez pas accès à la page demandée, et avez été redirigé sur cette page :');             
        }
        return $next($request);
    }
}
