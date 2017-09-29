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

 Route::get('/test', function () {
     $response = [
         'code' => '200',
         'msg' => 'success',
         'data' => [
             1,1,1,1,1,1
         ],
     ];
     return response()->json($response);
 });

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('app.index');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
| Rewrite basic auth routes
*/
Route::get('/home', 'HomeController@index')->name('home');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\MastiffLoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
