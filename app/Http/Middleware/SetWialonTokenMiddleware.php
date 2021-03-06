<?php

namespace App\Http\Middleware;

use Closure;

class SetWialonTokenMiddleware
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
        try {
            $token = (new \App\Setting())->getWialonToken();
            config(['services.wialon.token' => $token]);
        }catch (\Exception $exception) {
            info('setting wialon token unsuccesful');
        }


        return $next($request);
    }
}
