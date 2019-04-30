<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TenantIdentificationProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot()
    {
        $environment = $this->app->make(\Hyn\Tenancy\Environment::class);
        $website = app(\Hyn\Tenancy\Environment::class)->tenant();
        $environment->tenant($website);

    }
}
