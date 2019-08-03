<?php

namespace App\Providers;

use App\Validators\AccountValidator;
use Hyn\Tenancy\Validators\WebsiteValidator;
use Illuminate\Database\Eloquent\Relations\Relation;
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
        Relation::morphMap([
            'trucks' => 'App\TruckTract',
            'trailers' => 'App\TrailerBox',
        ]);
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
