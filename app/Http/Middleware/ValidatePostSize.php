<?php

namespace App\Http\Middleware;

use Closure;

class ValidatePostSize
{
    //pas en service dans le kernel
    
    public function handle($request, Closure $next)
    {
        $max = $this->getPostMaxSize();

        if ($max > 0 && $request->server('CONTENT_LENGTH') > $max) {
            // Check for route1
            // and do something

            // Check for route2
            // and do something else

            // Fallback for other routes
            return redirect()->back()->with('message', 'fichier trop gros'); 
        }
        return $next($request);
    }
}
