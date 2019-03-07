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
        $account = Account::where('uuid', $request->header('X-Tenant-id'))->first();

        $environment = app(\Hyn\Tenancy\Environment::class);
        $environment->tenant($account);

        return $next($request);
    }
}
