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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::namespace('Api')->group(function () {
    Route::post('registration', 'UsersController@store')->name('registration');
    Route::post('login', 'AppController@login')->name('login');
});

//Route::resource('users', 'UsersController','');
//Route::resource('announcements', 'AnnouncementsController');
//Route::resource('orders', 'OrdersController');
//Route::resource('scripts', 'ScriptsController');
//Route::resource('script-financials', 'ScriptFinancialsController');
//Route::resource('script-newslinks', 'ScriptNewslinksController');
