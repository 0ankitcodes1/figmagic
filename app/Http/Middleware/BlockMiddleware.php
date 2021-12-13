<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class BlockMiddleware
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
        $validator = \Validator::make($request->all(), [
            "admin_token" => ["required", "string", "min:1", "max:255"]
        ]);

        if ($validator->fails()) {
            return response([
                "response" => $validator->errors()
            ], 201);
        }
        else {
            if (Admin::where("token", $request->admin_token)->exists()) {
                return $next($request);
            }
            else {
                return response([
                    "response" => "Invalid Admin"
                ], 201);
            }
        }
    }
}
