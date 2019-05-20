<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;
use Laravel\Passport\Bridge\AccessToken;
use Illuminate\Support\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);  //https://laravel-news.com/laravel-5-4-key-too-long-error
        $this->registerPolicies();
        
        // Passport::personalAccessClientId('client-id'); // referencia
        // Passport::tokensExpireIn(now()->addSeconds(30));

        Passport::personalAccessTokensExpireIn(now()->addMinutes(10));
        Passport::refreshTokensExpireIn(Carbon::now()->addMinutes(300));
//         Passport::routes(function ($router) {
//            $router->forAccessTokens();
//            $router->forClients();
//        });

        Passport::routes();
    }
}
