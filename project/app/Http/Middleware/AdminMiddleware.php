<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{

    public function handle($request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->isAdmin() == 1) {
            return $next($request);
        }

        return response()->json(['message'=>'Forbidden for you'],403);
    }
}
