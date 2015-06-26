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

Route::group(['middleware' => ['auth', 'auth.admin']], function () {

  Route::get('/', 'HomeController@index');

  // 全局导航管理
  Route::get('navigators', 'NavigatorController@index');
  Route::post('navigators', 'NavigatorController@store');
  Route::put('navigators/{id}/toggle', 'NavigatorController@toggle');
  Route::put('navigators/{id}', 'NavigatorController@update');
  Route::delete('navigators/{id}', 'NavigatorController@destroy');

  // 轮播图
  Route::get('slides', 'SlideController@index');
  Route::get('slides/{id}', 'SlideController@show');
  Route::delete('slides/{id}', 'SlideController@destroy');
  Route::put('slides/{id}', 'SlideController@update');
  Route::post('slides', 'SlideController@store');
  // 轮播图中的项
  Route::post('slides/{slide_id}/slide-items', 'SlideItemController@store');
  Route::delete('slides/{slide_id}/slide-items/{id}', 'SlideItemController@destroy');
  Route::put('slides/{slide_id}/slide-items/{id}', 'SlideItemController@update');

  // 广告分类管理
  Route::get('ad-categories', 'AdCategoryController@index');
  Route::get('ad-categories/server-proccessing', 'AdCategoryController@server');
  Route::delete('ad-categories/{id}', 'AdCategoryController@destroy');
  Route::get('ad-categories/roots', 'AdCategoryController@roots');
  Route::put('ad-categories/{id}', 'AdCategoryController@update');
  Route::post('ad-categories', 'AdCategoryController@store');

  Route::group(['middleware' => 'verifyCurrentUser'], function () {
    // 用户账户管理
    Route::get('accounts/{id}', 'AccountController@show');
    Route::get('accounts/{id}/edit', 'AccountController@edit');
    Route::put('accounts/{id}/reset-password', 'AccountController@postResetPassword');
    Route::put('accounts/{id}/edit', 'AccountController@update');
    Route::put('accounts/{id}/enterprise', 'AccountController@updateEnterprise');

  });

  Route::get('admins', 'AdminController@index');
});

// 用户登录
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
// 用户注销登录
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// 提出密码重置请求
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// 密码重置
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
