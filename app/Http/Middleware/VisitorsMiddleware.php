<?php

namespace App\Http\Middleware;

use Closure;
use App\Band;

class VisitorsMiddleware
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
        $slug = $request->path();
        $prefix = 'groupe/';

        if (substr($slug, 0, strlen($prefix)) == $prefix) {
            $slug = substr($slug, strlen($prefix));
        } 

        if($band = Band::firstWhere('slug',$slug)){
            // dd('coucou');
            session(['band_id' => $band->id]);
            // dd(session()->get('band_id'));
            return $next($request);
        }
        // else return redirect()->route('nogroup');       
        else return redirect('songs');       
        
    }
}
