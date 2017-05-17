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
$gifs = json_decode(file_get_contents(base_path() . '/resources/mocks/search/cat/0.json'));

Route::get('/', function() use($gifs) {
  return view('index', [
    'endpoint' => '/api/trending/',
    'gifs' => $gifs
  ]);
});

Route::get('/trending', function() use($gifs) {
  $file = base_path() . '/resources/mocks/search/' . $term . '/' . $offset . '.json';

  if (file_exists($file)) {
      return json_decode(file_get_contents($file));
  }

  // Fallback on first json mock if we don't find a mock file
  return $gifs;
});
Route::get('/search/{search}', 'SearchController@index');
Route::middleware('auth')->get('/favorites', 'FavoritesController@index');
