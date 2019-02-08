<?php

use App\Http\Controllers\ConvoyController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
Route::post('password/send_email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('password/change', 'Auth\ResetPasswordController@reset');

//@todo proteger con autenticacion
Route::post('webhook/alert', 'NotificationTypeController@webhookAlert');

Route::group(["middleware" => [
    "auth:api",
//    "limit_simoultaneous_access",
//    "limit_expired_license_access",
    \App\Http\Middleware\ProfilingTestMiddleware::class
]], function ($router) { //@todo Documentar/aclarar/encontrar por que funciona con auth:web y no con auth:api
    Route::get("/me", "MeController@meInfo");
    Route::post('/me/change_password', 'UsersController@changePassword');
    Route::get('user/info', function(){
        return response([
            'id' => auth()->user()->id,
            'name' => auth()->user()->email,
            'roles' => ['admin']
        ]);
    }); // @TODO Put it in a controller and merge /me and /user/info

//Devices
    Route::resource("devices", "DevicesController")->except(['create','edit']);
    Route::get("contacts/filter_tags", "ContactController@filterTags");
    Route::post("contacts/{contact}/tags", "ContactController@attachtags");
    Route::resource("contacts", "ContactController")->except(['create','edit']);

    Route::resource("users", "UsersController", ["only" => ["store", "index","update", "destroy"]]);
//PERMISSIONS
    Route::put("permissions/user_sync/{user}", "PermissionController@userSync");
    Route::resource("permissions", "PermissionController", ["only" => ["index"]]);
    Route::post("roles/{role}/user", "RolesController@assignToUser");
    Route::resource("roles", "RolesController", ["only" => ["index", "store", "show", "update", "destroy"]]);


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
        "only" => ["index", "store", "update", "destroy"]
    ]);

//OPERATORS
    Route::resource("operators", "OperatorController", [
        "only" => ["store", "update", "show", "index", "destroy"]
    ]);

    // GEOFENCES
    Route::post('geofences', 'NotificationTypeController@createGeofence');
//NOTIFICATIONS
    Route::get("notification_activate/{notification_type}", "NotificationTypeController@activate");
    Route::resource("notification_types", "NotificationTypeController", [
        "only" => ["store", "update"]
    ]);

//Carriers
    Route::resource("carriers", "CarriersController", [
        "only" => ["index", "store", "show", "update", "destroy"]
    ]);

//Places (origenes y destinos)
    Route::resource("places", "PlaceController", [
        "only" => ["index", "store", "show", "update", "destroy"]
    ]);

//Units
    Route::get("units", "UnitsController@listUnits");
    Route::get("units/with_localization", "UnitsController@listUnitsLocalization");

    // Settings

    Route::post("settings", "SettingsController@general");
    Route::get("settings", "SettingsController@getSettings");

    //WIALON SECTION
    Route::get('wialon/resources', "WialonController@getResources");
    Route::get('wialon/notifications', "WialonController@getNotifications");
    Route::get('wialon/units', "WialonController@getUnits");
    Route::post('wialon/notifications', 'WialonController@store');


    //Laravel Normal Notifications Access
    Route::get('me/notifications', "MeController@getNotifications");
});



Route::group([
    "prefix" => "external/",
    "middleware" => [
        "auth:api"
    ]
], function ($router) { //@todo Documentar/aclarar/encontrar por que funciona con auth:web y no con auth:api

//Units
    Route::post("devices/{device}/localization", "DevicesController@updateLocalization");
    Route::post("devices", "DevicesController@storeExternal");
    Route::get("devices", "DevicesController@listDevices");
});

//Contacts

//SystemStatus


