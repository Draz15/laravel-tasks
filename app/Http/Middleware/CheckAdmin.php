<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        if (Auth::user()->role === "1") {
            return $next($request);
        }

        return response()->json(['message' => 'Forbidden - Admins only'], 403);
    }
}
