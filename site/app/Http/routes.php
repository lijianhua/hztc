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

Route::get('/', 'HomeController@index');
Route::get('/list', 'ListController@index');
Route::get('/adspaces/{name}', 'ListController@getAds');
Route::get('/search', 'SearchController@index');
Route::get('/cart', 'CartController@index');
Route::get('/pay', 'CartController@pay');
Route::get('/settlement', 'CartController@settlement');


//登录
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

//注册
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::get('auth/email/{id}','MailController@show');

//激活
Route::get('activing','MailController@index');

//用户
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


//用户中心
Route::get('user/{email}','UserController@showemail');
Route::get('users/order','UserController@order');
Route::get('users/score','UserController@score');
Route::get('users/collect','UserController@collect');
Route::get('users/score','UserController@score');
Route::post('users/infos','UserController@store_user_auth');
Route::post('users/info','UserController@store_company_auth');
Route::get('users/info','UserController@info');
