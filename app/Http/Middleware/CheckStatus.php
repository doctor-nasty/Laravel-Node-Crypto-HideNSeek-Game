<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckStatus
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

    if (Auth::user()->status == 1) {
        return $next($request);
    }

    if (Auth::user()->status == 3) {
        return $next($request);
    }

    if (Auth::user()->status == 0) {
        return redirect ('/disabled');
    }

    }
}
