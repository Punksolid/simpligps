<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;
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
     */
    public function boot()
    {
        Schema::defaultStringLength(191);  //https://laravel-news.com/laravel-5-4-key-too-long-error
        $this->registerPolicies();

        // Passport::personalAccessClientId('client-id'); // referencia
        // Passport::tokensExpireIn(now()->addSeconds(30));

        Passport::personalAccessTokensExpireIn(now()->addMinutes(config('auth.passwords.users.expire')));
        Passport::refreshTokensExpireIn(Carbon::now()->addMinutes(300));
//         Passport::routes(function ($router) {
//            $router->forAccessTokens();
//            $router->forClients();
//        });

        Passport::routes();
    }
}
