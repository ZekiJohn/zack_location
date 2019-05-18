<?php

namespace App\Http\Middleware;

use Closure;

class BanLocalhost
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
        if($request->ip() == "127.0.0.1"){
            return response()->json(['Error' => "Sorry! we don't support Localhost and staff here"], 200);
        }
        $response =  $next($request);
        $response->cookie('visited-owr-site', true);
        return $response;
    }
}
