<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserExpiry
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
        if (Auth::check() && Auth::user()->isExpired()) {
            Auth::logout(); // Log out the user
            return redirect()->route('login')->withErrors(['Your account has expired. Please contact support.']); 
        }

        return $next($request); // Continue request
    }
}
