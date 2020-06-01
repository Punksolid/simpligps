<?php

namespace App\Http\Middleware;

use App\Setting;
use Closure;

class SetTraccarConfigurations
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
        $base_url = Setting::query()
            ->where('key', 'traccar_base_url')
            ->firstOrFail()
            ->value;
        $username = Setting::query()
            ->where('key', 'traccar_username')
            ->firstOrFail()
            ->value;
        $password = Setting::query()
            ->where('key', 'traccar_password')
            ->firstOrFail()
            ->value;

        config([
            'traccar.base_url' => $base_url,
            'traccar.username' => $username,
            'traccar.password' => $password,
        ]);

        return $next($request);
    }
}
