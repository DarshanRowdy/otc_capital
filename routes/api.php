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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('tbl_users', 'Tbl_UsersController');
Route::resource('tbl_announcements', 'AnnouncementsController');
Route::resource('tbl_orders', 'OrdersController');
Route::resource('Scripts', 'ScriptsController');
Route::resource('tbl_script_financials', 'ScriptFinancialsController');
Route::resource('tbl_script_newslinks', 'ScriptNewslinksController');
