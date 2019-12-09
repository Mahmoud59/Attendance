<?php


Route::group(['prefix' => 'admin'], function () {

	Route::get('login', 'Admin\AuthController@loginForm');
	Route::post('login', 'Admin\AuthController@login');

    Route::group(['middleware' => ['checkLoginPanel']], function () {

		Route::get('logout', 'Admin\AuthController@logout');
		Route::resource('employees', 'Admin\EmployeeController');
		Route::get('employee/details/{employeeId}/month/{month}/year/{year}', 'Admin\EmployeeController@emplpoyeeDetails'); // get details for employee attendance

	});	
});