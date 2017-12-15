<?php

Route::get('/', function () {
	return redirect('api');
});

Route::group(array('prefix' => 'api'), function() {

	Route::get('/', function () {
		return response()->json(['message' => 'Jobs API', 'status' => 'Connected']);;
	});

	Route::post('auth/login', 'AuthController@authenticate');	
	
	// Company Routes
	Route::group(array('prefix' => 'companies'), function() {
		Route::get('/', 'CompaniesController@index');		
		Route::get('/reports', 'ReportsController@report');				
		Route::get('/{id}', 'CompaniesController@show');
		Route::post('/store', 'CompaniesController@store');
		Route::post('/event/{id}', 'CompaniesController@event' );
		Route::put('/update/{id}', 'CompaniesController@update');
		Route::delete('/delete/{id}', 'CompaniesController@destroy');
	});

	// Job Routes
	Route::group(array('prefix' => 'jobs'), function() {
		Route::get('/', 'JobsController@index');
		Route::get('/{id}', 'JobsController@show');
		Route::post('/store', 'JobsController@store');
		Route::put('/update/{id}', 'JobsController@update');
		Route::delete('/delete/{id}', 'JobsController@destroy');
	});	
});