<?php

namespace App\Http\Middleware;

use App\Account;
use Closure;
use Hyn\Tenancy\Events\Websites\Identified;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Models\Website;

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
        if (!Account::where('uuid', $request->header('X-Tenant-id'))->exists()) {
            abort(404);
        }

        $request->tenant_account = Account::where('uuid', $request->header('X-Tenant-id'))->first();
        $environment = app(\Hyn\Tenancy\Environment::class);
        $environment->tenant($request->tenant_account);

        return $next($request);
    }
}
