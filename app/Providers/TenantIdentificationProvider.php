<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TenantIdentificationProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot()
    {
        $environment = $this->app->make(\Hyn\Tenancy\Environment::class);
        $website = app(\Hyn\Tenancy\Environment::class)->tenant();
        $environment->tenant($website);
    }
}
