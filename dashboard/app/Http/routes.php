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

Route::controllers([
  'auth' => 'Auth\AuthController',
  'password' => 'Auth\PasswordController',
]);
