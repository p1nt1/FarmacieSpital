<?php

namespace App\Http\Middleware;

use Closure;

class IsFarmacist
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
        if(auth()->check() && $request->user()->farmacist != 0){
            return redirect()->guest('/');
        }

        return $next($request);
    }
}
