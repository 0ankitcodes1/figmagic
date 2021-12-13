<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Creator;

class EnsureLimitIsValid
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
        if (Creator::where('token', $request->token)->exists()) {
            $query = Creator::where('token', $request->token)->first();
            $limiter = (int)$query->apiLimiter;
            if ($limiter != 0) {
                return $next($request);
            }
            else {
                return response([
                    "message" => "Limit reached"
                ], 201);
            }
        }
    }
}
