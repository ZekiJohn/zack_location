<?php

namespace App\Http\Middleware;

use Closure;

class OnlyLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, $next)
    {
        if(auth()->check() && $role == 'admin'){
            //it's ok let it through
            return $next($request);
        }
        return response()->json(['Error: ' => 'Go Login First!'], 200);
    }
}
