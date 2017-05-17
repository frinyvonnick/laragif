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

Route::get('search/{term}/{offset}', 'SearchController@search');
 
Route::group(['middleware' => ['auth']], function () {
    Route::get('/star/{url}', 'FavoritesController@star');
    Route::get('/favorites/{offset}', 'FavoritesController@favorites');
});
