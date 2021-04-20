<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class checkUserActive
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
        if(Auth::check() && Auth::user()->status == "Deactivated")
        {
            Auth::logout();
            return redirect()->route('login')->withErrors('Your account has been deactivated by the admin. Please contact administrator.');
        }

        return $next($request);
    }
}
