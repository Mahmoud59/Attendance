<?php

Route::namespace('APIs\Employee')->group(function () {

	Route::post('login', 'AuthController@login');

	Route::group(['middleware' => ['auth:employee-api']], function() {
	    Route::get('logout', 'AuthController@logout');
	    Route::post('check', 'AttendanceController@check');

	});

});
