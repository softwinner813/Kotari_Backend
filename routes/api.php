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

Route::prefix('v1')->group(function () {

	Route::get('getHouseList', 'ApiController@getHouseList');
	Route::post('getHouseList', 'ApiController@getHouseList');
	Route::get('getRoomList', 'ApiController@getRoomList');
	Route::post('houseFilter', 'ApiController@houseFilter');
	Route::post('roomFilter', 'ApiController@roomFilter');

	Route::post('nameSearch', 'ApiController@nameSearch');

	// Route::get('filter', 'ApiController@filter');
});


