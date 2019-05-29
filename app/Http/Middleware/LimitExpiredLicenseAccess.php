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
//        $account = \Auth::user()->accounts()->first();
        $account = Account::whereUuid($request->header("X-Tenant-Id"))->first();

        //TODO Revisar todas las licencias ahora solo revisa una
        abort_unless($account->isActive(), 401, "No tiene una licencia activa");

        return $next($request);
    }
}
