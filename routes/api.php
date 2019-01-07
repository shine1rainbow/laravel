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
Route::group(['prefix' => 'v1', 'middleware' => 'operation.log'], function () {

	Route::group(['namespace' => 'Api\V1'], function () {

        //店铺管理
        Route::group(['prefix' => 'shop'], function () {
            Route::get('/', 'ShopController@index');
            Route::get('{id}', 'ShopController@show');
            Route::get('menutypes/{id}', 'ShopController@menutypes');
            Route::get('menucategories/{id}', 'ShopController@menucategories');
            Route::get('menus/{id}', 'ShopController@menus');
        });

        //一级菜单管理
        Route::group(['prefix' => 'menutype'], function () {
            Route::get('/', 'MenuTypeController@index');
            Route::get('menucategories/{id}', 'MenuTypeController@menuCategories');
            Route::get('{id}', 'MenuTypeController@show');
        });

        //二级菜单管理
        Route::group(['prefix' => 'menucategory'], function () {
            Route::get('/', 'MenuCategoryController@index');
            Route::get('menus/{id}', 'MenuCategoryController@menus');
            Route::get('{id}', 'MenuCategoryController@show');
        });

		//菜单管理
		Route::group(['prefix' => 'menu'], function () {
			Route::get('/', 'MenuController@index');
			Route::get('{id}', 'MenuController@show');
			Route::get('menuadditions/{id}', 'MenuController@menuAdditions');
			Route::get('menuoptions/{id}', 'MenuController@menuOptions');
		});

        //附加菜管理
        Route::group(['prefix' => 'menuaddition'], function () {
            Route::get('/', 'MenuAdditionController@index');
            Route::get('{id}', 'MenuAdditionController@show');
        });

        //配菜管理
        Route::group(['prefix' => 'menuoption'], function () {
            Route::get('/', 'MenuOptionController@index');
            Route::get('{id}', 'MenuOptionController@show');
        });

	});

	Route::group(['prefix' => 'backend', 'namespace' => 'Backend', 'middleware' => 'auth:api'], function () {

		//用户管理
		Route::group(['prefix' => 'user'], function () {
			Route::get('info', 'UserController@info');
			Route::get('menutype', 'UserController@getMenuTypeByUser');
			Route::get('picture', 'UserController@getPictureByUser');
			Route::get('menucategory', 'UserController@getMenuCategoryByUser');
			Route::get('menu', 'UserController@getMenuByUser');
			Route::get('menuoption', 'UserController@getMenuOptionByUser');
			Route::get('menuaddition', 'UserController@getMenuAdditionByUser');
			Route::get('tag', 'UserController@getTagByUser');
			Route::get('staff', 'UserController@getStaffByUser');
			Route::get('shop', 'UserController@getShopByUser');
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
			Route::get('menucategories/{id}', 'MenuTypeController@menuCategories');
			Route::get('{id}', 'MenuTypeController@show');
			Route::put('{id}', 'MenuTypeController@update');
			Route::delete('{id}', 'MenuTypeController@destroy');
			Route::post('/', 'MenuTypeController@store');
		});

		//二级菜单管理
		Route::group(['prefix' => 'menucategory'], function () {
			Route::post('/', 'MenuCategoryController@store');
			Route::get('menus/{id}', 'MenuCategoryController@menus');
			Route::get('{id}', 'MenuCategoryController@show');
			Route::get('user', 'MenuCategoryController@user');
			Route::put('{id}', 'MenuCategoryController@update');
			Route::delete('{id}', 'MenuCategoryController@destroy');
		});

		//菜单管理
		Route::group(['prefix' => 'menu'], function () {
			Route::post('/', 'MenuController@store');
			Route::get('menuadditions/{id}', 'MenuController@menuAdditions');
			Route::get('menuoptions/{id}', 'MenuController@menuOptions');
			Route::get('{id}', 'MenuController@show');
			Route::get('user', 'MenuController@user');
			Route::put('{id}', 'MenuController@update');
			Route::delete('{id}', 'MenuController@destroy');
		});

		//附加菜管理
		Route::group(['prefix' => 'menuaddition'], function () {
			Route::post('/', 'MenuAdditionController@store');
			Route::get('{id}', 'MenuAdditionController@show');
			Route::get('user', 'MenuAdditionController@user');
			Route::put('{id}', 'MenuAdditionController@update');
			Route::delete('{id}', 'MenuAdditionController@destroy');
		});

		//配菜管理
		Route::group(['prefix' => 'menuoption'], function () {
			Route::post('/', 'MenuOptionController@store');
			Route::get('{id}', 'MenuOptionController@show');
			Route::get('user', 'MenuOptionController@user');
			Route::put('{id}', 'MenuOptionController@update');
			Route::delete('{id}', 'MenuOptionController@destroy');
		});

		//员工
		Route::group(['prefix' => 'staff'], function () {
			Route::post('/', 'StaffController@store');
			Route::put('{id}', 'StaffController@update');
			Route::get('{id}', 'StaffController@show');
			Route::delete('{id}', 'StaffController@destroy');
		});


		//图片管理
		Route::group(['prefix' => 'picture'], function () {
			Route::post('getUploadPath', 'PictureController@getUploadPath');
			Route::get('/', 'PictureController@index');
			Route::post('/', 'PictureController@store');
			Route::get('{id}', 'PictureController@show');
			Route::put('{id}', 'PictureController@update');
			Route::delete('{id}', 'PictureController@destroy');
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
