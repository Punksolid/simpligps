<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('api/', function () {
    if (\App\User::first()) {
        return response()->json('ok');
    }

    return abort(500, 'database problem');
});
Route::domain('sysadmin.localhost')->group(function () {
    Route::get('/', 'HomeController@sysadmin')->where('any', '.*');
});
Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]); // comentado por que truena comando route:list y descomentado por que se necesita para la auth de los websockets

Route::get('/home', 'HomeController@index')->name('home');
