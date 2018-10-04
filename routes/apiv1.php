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

Route::middleware('auth:api')->get('/me', "MeController@meInfo");

Route::resource("users", "UsersController", ["only" => ["store", "index"]]);
//PERMISSIONS
Route::put("permissions/user_sync/{user}", "PermissionController@userSync");
Route::resource("permissions", "PermissionController", ["only" => ["index"]]);
Route::post("roles/{role}/user", "RolesController@assignToUser");
Route::resource("roles", "RolesController", ["only" => ["index", "store", "show", "update", "destroy"]]);

Route::post('login', 'Auth\LoginController@login');

Route::post('password/send_email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('password/change', 'UsersController@changePassword');
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

Route::group(["middleware" => ["auth:api", "limit_simoultaneous_access", "limit_expired_license_access"]], function ($router) { //@todo Documentar/aclarar/encontrar por que funciona con auth:web y no con auth:api
//Devices
    Route::resource("devices", "DevicesController")->only("index", "store", "show", "destroy", "update");

});


//Contacts
Route::get("contacts/filter_tags", "ContactController@filterTags");
Route::post("contacts/{contact}/tags", "ContactController@attachtags");
Route::resource("contacts", "ContactController")->only("index", "store", "show", "destroy", "update");

