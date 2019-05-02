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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
	Route::get('/student', function () {
		return view('student');
	});

	Route::get('/fetch_data', 'StudentController@fetch_data');
	Route::get('/student/view', 'StudentController@studentList');
	//Route::get('/laravel-ajax-pagination',array('as'=>'ajax-pagination','uses'=>'StudentController@studentList'));
	Route::post('/student/post', 'StudentController@addStudent');
});	
Route::get('/home', 'HomeController@index')->name('home');
