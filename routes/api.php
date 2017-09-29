<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| API Routes Version 1.0(current)
|--------------------------------------------------------------------------
| tip: In local remove the middleware auth:api, but when app online your
| should never missing it.
*/
Route::group(['prefix' => 'v2', 'namespace' => 'Api\V1'], function () {
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
