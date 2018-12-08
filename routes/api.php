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
			Route::get('menutype', 'UserController@getMenuTypeByUser');
			Route::get('menucategory', 'UserController@getMenuCategoryByUser');
			Route::get('menu', 'UserController@getMenuByUser');
			Route::get('permission', 'UserController@getPermissionByUserId');
			Route::get('/', 'UserController@index');
			Route::post('/', 'UserController@store');
			Route::get('{id}', 'UserController@show');
			Route::put('{id}', 'UserController@update');
			Route::delete('{id}', 'UserController@destroy');
		});

		//图片标签管理
		Route::group(['prefix' => 'tag'], function () {
			Route::get('user', 'TagController@user');
			Route::get('/', 'TagController@index');
			Route::post('/', 'TagController@store');
			Route::get('{id}', 'TagController@show');
			Route::put('{id}', 'TagController@update');
			Route::delete('{id}', 'TagController@destroy');
		});

		//店铺管理
		Route::group(['prefix' => 'shop'], function () {
			Route::get('user', 'ShopController@user');
			Route::get('/', 'ShopController@index');
			Route::post('/', 'ShopController@store');
			Route::get('{id}', 'ShopController@show');
			Route::put('{id}', 'ShopController@update');
			Route::delete('{id}', 'ShopController@destroy');
			Route::post('uploadImg', 'ShopController@uploadImg');
			Route::get('menutypes/{id}', 'ShopController@menutypes');
			Route::get('menucategories/{id}', 'ShopController@menucategories');
			Route::get('menus/{id}', 'ShopController@menus');
			Route::get('staffs/{id}', 'ShopController@staffs');
		});

		//店铺状态
		Route::group(['prefix' => 'shopstatus'], function () {
			Route::get('/', 'ShopStatusController@index');
		});

		//一级菜单管理
		Route::group(['prefix' => 'menutype'], function () {
			Route::get('user', 'MenuTypeController@user');
			Route::put('{id}', 'MenuTypeController@update');
			Route::delete('{id}', 'MenuTypeController@destroy');
		});

		//图片管理
		Route::group(['prefix' => 'picture'], function () {
			Route::post('getUploadPath', 'PictureController@getUploadPath');
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
