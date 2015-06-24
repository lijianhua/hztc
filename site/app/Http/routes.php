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
Route::get('/search', 'SearchController@index');
Route::get('/cart', 'CartController@index');
Route::get('/pay', 'CartController@pay');
Route::get('/settlement', 'CartController@settlement');


Route::controllers([
  'auth' => 'Auth\AuthController',
  'password' => 'Auth\PasswordController',
]);
