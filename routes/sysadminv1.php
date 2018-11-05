<?php

use App\Http\Controllers\ConvoyController;
use Illuminate\Http\Request;
use Laravel\Passport\Passport;

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
Passport::routes(function ($router) {
    $router->forAccessTokens();
//    $router->forClients();
});
Route::group(["middleware" => ['api']], function ($router){
    Route::post('login', 'AdminLoginController@login');
});

Route::group(["middleware" => ["auth:sysadmin-api"]], function ($router) {
    Route::get('user/info', function(){
        return response(['name' => auth()->user()->email, 'roles' => ['admin']]);
    });

    Route::put("accounts/{account}/fiscal", "Admin\AccountsController@fiscal");
    Route::get("accounts/active_accounts", "Admin\AccountsController@activeAccounts");
    Route::get("accounts/near_to_expire", "Admin\AccountsController@nearToExpire");
    Route::resource("accounts", "Admin\AccountsController")->only("store", "index", "destroy");

//Dashboard
    Route::get('dashboard/accounts', 'Admin\DashboardController@accounts');

//Licenses
    Route::post("licenses/{license}/assign_to_account", "LicenseController@assignToAccount");
    Route::post("licenses/{license}/revoke", "LicenseController@revoke");
    Route::resource("licenses", "LicenseController")->except("create");
});

//Accounts



