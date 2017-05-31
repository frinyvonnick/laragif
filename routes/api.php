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

Route::get('trending/{offset}', 'TrendingController@trending');
Route::get('search/{term}/{offset}', 'SearchController@search');

Route::group(['middleware' => ['auth']], function () {
    Route::put('/star/{url}', 'FavoritesController@star');
    Route::get('/favorites/{offset}', 'FavoritesController@favorites');
    Route::get('/star/{id}', 'FavoritesController@isStarred');
});
