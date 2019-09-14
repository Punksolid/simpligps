<?php

namespace App\Http\Middleware;

use App\Account;
use Closure;

class LimitExpiredLicenseAccess
{
    /**
     * Revisa que la cuenta se activa, este middleware solo va despu[es del identificador de tenant provisto por
     * Capas superiores de middlewares
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        abort_unless($request->tenant_account->isActive(), 401, 'No tiene una licencia activa');

        return $next($request);
    }
}
