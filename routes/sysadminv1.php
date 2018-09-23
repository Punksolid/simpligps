
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

Route::post('login', 'AdminLoginController@login');


//Accounts
Route::put("accounts/{account}/fiscal", "AccountsController@fiscal");
Route::resource("accounts", "Admin\AccountsController")->only("store","index", "destroy");
Route::group(["middleware" => "api"], function (){


});


//Dashboard
Route::get('dashboard/accounts', 'Admin\DashboardController@accounts');

//Licenses
Route::post("licenses/{license}/assign_to_account", "LicenseController@assignToAccount");
Route::resource("licenses", "LicenseController");


