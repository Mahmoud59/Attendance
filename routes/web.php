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

Route::get('users', 'Admin\DashboardController@index');

Route::group(['prefix' => 'admin'], function () {
	Route::get('login', 'Admin\AuthController@loginForm');
	Route::post('login', 'Admin\AuthController@login');

    Route::group(['middleware' => ['checkLoginPanel']], function () {

		Route::get('logout', 'Admin\AuthController@logout');

		Route::resource('employees', 'Admin\EmployeeController');

		Route::get('employee/details/{employeeId}/month/{month}/year/{year}', 'Admin\EmployeeController@emplpoyeeDetails');

	});	
});