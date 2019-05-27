<?php

namespace App\Http\Middleware;

use Closure;

class RefreshPersonalAccessTokenMiddleware
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
        $response =  $next($request);

        $user = auth()->user();
        $token = $user->token();
        
        // now()->greaterThan()
        if (now()->between($token->expires_at, $token->expires_at->copy()->subMinutes(5))) {
            $new_token = $user->createToken('Refreshed Personal Access Token')->accessToken;
            $response->header('X-Token', $new_token);
            $response->header('Access-Control-Expose-Headers', "X-Token");
        }

        
        return $response;
    }
}
