<?php

namespace App\Http\Middleware;

use Closure;

class IsUserPermittedInAccountMiddleware
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
        if ($request->user()->isInAccount($request->tenant_account->id)) {
            return $next($request);
        }

        abort(403, "User Not In Account");
    }
}
