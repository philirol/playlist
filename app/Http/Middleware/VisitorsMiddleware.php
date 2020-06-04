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
        $prefix = config('app.visitors_urlslugprefix');

        // we get the slug here
        if (substr($slug, 0, strlen($prefix)) == $prefix) {
            $slug = substr($slug, strlen($prefix));
        } 
        // if slug is found
        if($band = Band::firstWhere('slug',$slug)){
            session(['band_slug_for_visitors' => $band->slug]);
            session(['visitors' => 1]);
            session(['band' => $band]);
            return $next($request);
        }
        // if not
        else return redirect()->route('nogroup');       
        // else return redirect('songs');       
        
    }
}
