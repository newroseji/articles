<?php

	/*
	|--------------------------------------------------------------------------
	| Application Routes
	|--------------------------------------------------------------------------
	|
	| Here is where you can register all of the routes for an application.
	| It's a breeze. Simply tell Laravel the URIs it should respond to
	| and give it the controller to call when that URI is requested.
	|
	*/

	Route::get('/', function () {
		return view('app');
	});


	Route::resource('articles', 'ArticlesController');
	Route::post('article/photos/{articles}', ['as' => 'store_photo_path', 'uses' => 'ArticlesController@addPhoto']);

	Route::delete('photos/{id}', 'PhotosController@destroy');

	Route::auth();
	Route::get('register/confirm/{token}', 'Auth\AuthController@confirmEmail');


	Route::get('user/dashboard', 'UsersController@dashboard');
	Route::get('user/profile', 'UsersController@profile');
	Route::get('user/edit', 'UsersController@edit');
	Route::post('user/update', 'UsersController@update');
	Route::post('user/pw', 'UsersController@pwUpdate');