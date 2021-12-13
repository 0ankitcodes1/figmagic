<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use \App\Models\Creator;
use \App\Models\Collaborator;

class EnsureRequestIsAvailable
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
        if(Creator::where('token', $request->token)->exists()) {
            $query = Creator::where("token", $request->token)->first();
            $apiLimiter = (int)$query->apiLimiter;
            if ($apiLimiter > 0) {
                return $next($request);
            }
            else {
                return response([
                    "message" => "Your request was blocked"
                ], 201);
            }
        }
        else if (Collaborator::where('token', $request->token)->exists()) {
            $query = Collaborator::where("token", $request->token)->first();
            $apiLimiter = (int)$query->apiLimiter;
            if ($apiLimiter > 0) {
                return $next($request);
            }
            else {
                return response([
                    "message" => "Your request was blocked"
                ], 201);
            }
        }
        else {
            return response([
                "message" => "Token is missing"
            ], 201);
        }
    }
}
