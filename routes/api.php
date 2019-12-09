<?php

Route::namespace('APIs\Employee')->group(function () {

	Route::group(['prefix' => 'employee'], function () {

		Route::post('login', 'AuthController@login');	

		Route::middleware('checkUser')->group(function () {
		    Route::get('logout', 'AuthController@logout');
		    Route::post('check', 'AttendanceController@check');		// employee check-in and check-out

		});
	});	
});
