<?php

namespace App\Providers;

use App\Validators\AccountValidator;
use Hyn\Tenancy\Validators\WebsiteValidator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     * Once in application boot.
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     * Each provider.
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }

        app()->singleton(WebsiteValidator::class, AccountValidator::class);
    }
}
