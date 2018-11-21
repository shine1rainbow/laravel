<?php

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

/*
|--------------------------------------------------------------------------
| API Routes Version 1.0(current)
|--------------------------------------------------------------------------
| tip: In local remove the middleware auth:api, but when app online your
| should never missing it.
*/
Route::group(['prefix' => 'v1'], function () {

	Route::group(['namespace' => 'Api\V1'], function () {
	});

	Route::group(['prefix' => 'backend', 'namespace' => 'Backend', 'middleware' => 'auth:api'], function () {

		//用户管理
		Route::group(['prefix' => 'user'], function () {
			Route::get('info', 'UserController@info');
			Route::get('permission', 'UserController@getPermissionByUserId');
			Route::get('/', 'UserController@index');
			Route::post('/', 'UserController@store');
			Route::get('{id}', 'UserController@show');
			Route::put('{id}', 'UserController@update');
			Route::delete('{id}', 'UserController@destroy');
		});

	});

});

/*
|--------------------------------------------------------------------------
| API Routes Version 2.0(preview)
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'v2', 'namespace' => 'Api\V2'], function () {
});

/*
|--------------------------------------------------------------------------
|  API Routes(test)
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'map', 'namespace' => 'Api\V1'], function () {
});
