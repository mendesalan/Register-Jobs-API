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
	return redirect('api');
});

Route::group(array('prefix' => 'api'), function() {

	Route::get('/', function () {
		return response()->json(['message' => 'Jobs API', 'status' => 'Connected']);;
	});

	Route::post('auth/login', 'AuthController@authenticate');
	
	Route::group(array('prefix' => 'companies'), function() {
		Route::get('/', 'CompaniesController@index');				
		Route::get('/{id}', 'CompaniesController@show');
		Route::post('/store', 'CompaniesController@store');
		Route::put('/update/{id}', 'CompaniesController@update');
		Route::delete('/delete/{id}', 'CompaniesController@destroy');
	});

	Route::group(array('prefix' => 'jobs'), function() {
		Route::get('/', 'JobsController@index');
		Route::get('/{id}', 'JobsController@show');
		Route::post('/store', 'JobsController@store');
		Route::put('/update/{id}', 'JobsController@update');
		Route::delete('/delete/{id}', 'JobsController@destroy');
	});	
});

// ### Route exaomples ####

// Route::get($uri, $callback);
// Route::post($uri, $callback);
// Route::put($uri, $callback);
// Route::patch($uri, $callback);
// Route::delete($uri, $callback);
// Route::options($uri, $callback);

// Redirect a route
// Route::redirect('/here', '/there', 301);

// return a view
// Route::get('/', function () {
//     return view('welcome');
// });