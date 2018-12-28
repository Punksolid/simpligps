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
Route::get('api/', function (){

    if (\App\User::first()){
     return response()->json('ok');
    }
    return abort(500);

});
Route::domain("sysadmin.localhost")->group(function () {
    Route::get('/', 'HomeController@sysadmin')->where('any', '.*');
});
Route::get('/', function () {

    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


