<?php

use App\Http\Middleware\IdentifyTenantConnection;
use App\Http\Middleware\IsUserPermittedInAccountMiddleware;
use App\Http\Middleware\ProfilingTestMiddleware;
use App\Http\Middleware\RefreshPersonalAccessTokenMiddleware;
use App\Http\Middleware\SetWialonTokenMiddleware;
use Illuminate\Support\Facades\Route;


Route::group(
    [
        'middleware' => [
//    "verified",
            'auth:api',
            RefreshPersonalAccessTokenMiddleware::class,
            ProfilingTestMiddleware::class,
        ],
    ],
    function () { //@todo Documentar/aclarar/encontrar por que funciona con auth:web y no con auth:api
        //Laravel Normal Notifications Access

        Route::group(
            [
                'middleware' => [
                    IdentifyTenantConnection::class,
                    'limit_expired_license_access',
                    IsUserPermittedInAccountMiddleware::class,
                    SetWialonTokenMiddleware::class,
                    'limit_simoultaneous_access',
                ],
            ],
            function () {
                Route::resource(
                    'trips',
                    'V2\TripsController',
                    [ 'only' => ['index'] ]
                );

            }
        );
    }
);
