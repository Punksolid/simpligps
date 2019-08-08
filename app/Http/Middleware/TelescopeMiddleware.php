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
        if (auth()->check()) {
            if (auth()->user()->email === 'punksolid@gmail.com' or auth()->user()->email === 'josepablogr@gmail.com') {
                return $next($request);
            }
        }
        abort(403);
    }
}
