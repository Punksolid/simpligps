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
            if ('punksolid@gmail.com' === auth()->user()->email or 'josepablogr@gmail.com' === auth()->user()->email) {
                return $next($request);
            }
        }
        abort(403);
    }
}
