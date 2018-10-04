<?php

namespace App\Http\Middleware;

use App\Account;
use Closure;

class LimitExpiredLicenseAccess
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
        $account = \Auth::user()->accounts()->first();
        //TODO Revisar todas las licencias ahora solo revisa una
        if ($account->isActive()){
            return $next($request);
        }

        return response()->json(["message" => "No tiene una licencia activa"]);
    }
}
