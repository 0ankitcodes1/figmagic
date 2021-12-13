<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CROS
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request)
        ->header("Access-Control-Allow-Orign", "*")
        ->header("Access-Control-Allow-Method", "GET, POST, PUT, PATCH, DELETE, OPTIONS")
        ->header("Access-Control-Headers", "Content-Type, Authorization");
    }
}
