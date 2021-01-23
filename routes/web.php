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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



/*
|--------------------------------------------------------------------------
| Web Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your Hotel Control Panel  application. 
|
*/
Route::prefix('admin')->group(function () {
	Route::get('/', function(){
		return redirect('/admin/dashboard');
	});

	//============ Dashboard
	Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');

	//============ Add House
	Route::get('addHouse', 'HomeController@addHouse')->name('addHouse');
	Route::post('addHousePost', 'HomeController@addHousePost');

	//============ Add Room
	Route::get('addroom/{id}', 'HomeController@addRoom')->name('addRoom');
	Route::post('addRoomPost', 'HomeController@addRoomPost');


	//============ House Rooms
	Route::prefix('houselist')->group(function () {
		Route::get('/{visible?}', 'HomeController@houseList')->name('houseList');
		Route::post('/houseVisible', 'HomeController@houseVisible')->name('houseVisible');
	});

	//============ House Detail
	Route::prefix('houseDetail')->group(function () {
		Route::get('/{id}', 'HomeController@houseDetail');
		Route::post('/delImage', 'HomeController@delImage')->name('delImage');
	});


	//============ List Rooms
	Route::prefix('roomlist')->group(function () {
		Route::get('/{house_id}/{visible?}', 'HomeController@roomList')->name('roomList');
		Route::post('/setVisible', 'HomeController@setVisible')->name('setVisible');
		Route::post('/deleteRoom', 'HomeController@deletRoom')->name('deleteRoom');
		
	});


	//============ Room Detail
	Route::prefix('roomDetail')->group(function () {
		Route::get('/{id}', 'HomeController@roomDetail');
		Route::post('/delImage', 'HomeController@delImage')->name('delImage');
	});

});
