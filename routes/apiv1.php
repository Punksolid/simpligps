<?php

use App\Http\Controllers\ConvoyController;
use App\Http\Middleware\IdentifyTenantConnection;
use Illuminate\Http\Request;

Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
Route::post('password/send_email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('password/change', 'Auth\ResetPasswordController@reset');

//@todo proteger con autenticacion
Route::post('webhook/alert', 'NotificationTypeController@webhookAlert');

Route::group(["middleware" => [
    "auth:api",
//    "limit_simoultaneous_access",
    \App\Http\Middleware\ProfilingTestMiddleware::class
]], function ($router) { //@todo Documentar/aclarar/encontrar por que funciona con auth:web y no con auth:api
    //Laravel Normal Notifications Access
    Route::get('me/notifications', "MeController@getNotifications");
    Route::get("/me", "MeController@meInfo");

    Route::get("/me/permissions", "MeController@permissions");
    Route::get("/me/accounts", "MeController@accounts");
    Route::post('/me/change_password', 'UsersController@changePassword');

    Route::group([
        "middleware" => [
            IdentifyTenantConnection::class,
            "limit_expired_license_access"
        ]
    ],function($router){
        //Devices
        Route::post("devices/{device}/link_unit", "DevicesController@linkUnit");
        Route::resource("devices", "DevicesController")->except(['create','edit']);

        //Contacts
        Route::get("contacts/filter_tags", "ContactController@filterTags");
        Route::post("contacts/{contact}/tags", "ContactController@attachtags");
        Route::resource("contacts", "ContactController")->except(['create','edit']);

        //PERMISSIONS
        Route::put("permissions/user_sync/{user}", "PermissionController@userSync");
        Route::resource("permissions", "PermissionController", ["only" => ["index"]]);
        Route::post("roles/{role}/user", "RolesController@assignToUser");
        Route::resource("roles", "RolesController", ["except" => ["edit", "create"]]);

        //CONVOYS
        Route::post("trips/convoys", "ConvoyController@store");
        Route::get("trips/convoys", "ConvoyController@index");
        Route::get("trips/convoys/{convoy}", "ConvoyController@show");

        //TRIPS
        Route::post("trips/upload", "TripsController@upload");
        Route::post("trips/{trip}/tags", "TripsController@assignTag");
        Route::post("trips/filtered_with_tags", "TripsController@filteredWithTags");
        Route::resource("trips/{trip}/traces", "TraceController")->only(["index", "store"]);
        Route::resource("trips", "TripsController", [
            "except" => ["create","edit"]
        ]);

        //OPERATORS
        Route::resource("operators", "OperatorController", [
            "except" => ["edit", "create"]
        ]);

        //Carriers
        Route::resource("carriers", "CarriersController")->except(["edit","create"]);

        //Places (origenes y destinos)
        Route::resource("places", "PlaceController")->except(["edit", "create"]);

        Route::group(["middleware" => \App\Http\Middleware\SetWialonTokenMiddleware::class],function ($router){
            //Units
            Route::get("units", "UnitsController@listUnits");
            Route::get("units/with_localization", "UnitsController@listUnitsLocalization");

            //WIALON SECTION
            Route::get('wialon/resources', "WialonController@getResources");
            Route::get('wialon/notifications', "WialonController@getNotifications");
            Route::get('wialon/units', "WialonController@getUnits");
            Route::post('wialon/notifications', 'WialonController@store');
        });

        //NOTIFICATIONS
        Route::get("notification_activate/{notification_type}", "NotificationTypeController@activate");
        Route::resource("notification_types", "NotificationTypeController", [
            "only" => ["store", "update"]
        ]);

        Route::resource("users", "UsersController", ["except" => ["edit", "create"]]);

        // GEOFENCES
        Route::post('geofences', 'NotificationTypeController@createGeofence');

        // Settings
        Route::post("settings", "SettingsController@general");
        Route::get("settings", "SettingsController@getSettings");



        Route::group([
            "prefix" => "external/",
        ], function ($router) {

            //Units
            Route::post("devices/{device}/localization", "DevicesController@updateLocalization");
            Route::post("devices", "DevicesController@storeExternal");
            Route::get("devices", "DevicesController@listDevices");
        });
    });



});



