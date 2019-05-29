<?php

namespace App\Http\Middleware;

use Closure;

class TelescopeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->email === 'punksolid@gmail.com') {
            return $next($request);
        }
        abort(403);
    }
}
