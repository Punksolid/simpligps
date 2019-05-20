<?php

namespace App\Http\Middleware;

use App\Account;
use Closure;
use Hyn\Tenancy\Events\Websites\Identified;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Models\Website;
use Spatie\Permission\Exceptions\UnauthorizedException;

/**
 * Primero se ejecuta este middleware que el de authenticacion
 */
class IdentifyTenantConnection
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

        //TODO add verification of user in account
        // dd('aa'); // 

        // $user = auth()->check() ? auth()->user() : abort(401, "Not authenticated");
        $uuid = $request->header('X-Tenant-id');

        // $request->tenant_account = $user->accounts()->whereUuid($uuid)->first();
        $request->tenant_account = Account::whereUuid($uuid)->first();

        // if ($request->tenant_account) {
            $environment = app(\Hyn\Tenancy\Environment::class);
            $environment->tenant($request->tenant_account);
            return $next($request);
        // }

        // abort_if(Account::whereUuid($uuid)->exists(), 403, "Not Authorized");

        abort(404, "Account Not Found");
    }
}
