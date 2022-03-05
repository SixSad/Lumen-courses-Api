<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OwnerMiddleware
{

    public function handle($request, Closure $next)
    {
        if (Auth::user()->id==$request->route('id')) {
            return $next($request);
        }
        return response()->json(['message'=>'You are not the owner'],403);
    }
}
