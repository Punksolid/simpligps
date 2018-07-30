<?php

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

Route::middleware('auth:api')->get('/me', function (Request $request) {
    return $request->user();
});

Route::resource("users", "UsersController",["only" => "store"]);

Route::post('login', 'Auth\LoginController@login');

Route::post('password/send_email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('password/change', 'UsersController@changePassword');


