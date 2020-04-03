<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if (Auth::check() && $request->user()->admin){ //admin boolean
            return $next($request);
        }
        return redirect('songs')->with('messageDanger', __('Vous n\'avez pas accès à la page demandée')); 
        // return new RedirectResponse(url('songs'));
    }
}
