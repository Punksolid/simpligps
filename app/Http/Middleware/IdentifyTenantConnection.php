<?php

namespace App\Http\Middleware;

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

        $website = Website::where('uuid', $request->header('X-Tenant-id'))->first();

        $environment = app(\Hyn\Tenancy\Environment::class);

        $environment->tenant($website);
        return $next($request);
    }
}
