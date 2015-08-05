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
Route::get('/ads/{id}', 'AdSpaceController@show');
Route::get('/search', 'SearchController@index');
Route::get('/cart', 'CartController@index');
Route::delete('cart/cartdel/{id}', 'CartController@CartDel');
Route::post('cart/addcart', 'CartController@create');
Route::post('/pay', 'CartController@payMent');
Route::post('/gopay', 'CartController@goPay');
Route::get('/settlement', 'CartController@settlement');
Route::post('/spacesale', 'CartController@spaceSalecount');

Route::get('alipay/return', 'CartController@webReturn');
Route::get('alipay/notify', 'CartController@webNotify'); 

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
Route::get('users/orderDetail/{id}','UserController@orderDetail');
Route::post('users/endorder','UserController@endOrder');
Route::delete('users/orderDel/{id}/{state}','UserController@orderDel');
Route::get('users/comment/{id}','UserController@getComment');
Route::post('users/comment','UserController@addComment');
Route::get('users/score','UserController@score');
Route::get('users/collect','UserController@collect');
Route::delete('users/collectDel/{id}','UserController@collectDel');
Route::get('users/score','UserController@score');
Route::post('users/infos','UserController@store_user_auth');
Route::post('users/info','UserController@store_company_auth');
Route::get('users/info','UserController@info');
Route::get('users/refund','UserController@refund');
Route::get('users/refund/detail/{id}','UserController@detail');
Route::post('collect/','AdSpaceController@addCollect');

Route::post('/SMS','SmsController@message');
// 搜索
Route::any('search', 'SearchController@search');
Route::get('/Search/list', 'SearchController@search_list_filter');
//列表

//底部
Route::get('/about.html', 'AboutController@index');
Route::get('/about/contact.html', 'AboutController@contact');
Route::get('/about/law.html', 'AboutController@law');
Route::get('/404.html', 'AboutController@notFound');
Route::get('/500.html', 'AboutController@notCode');
//列表搜索
Route::get('/list/{list}/{sort?}', 'AdSpaceController@ad_list');
//首页检索
Route::post('/Search','SearchController@search_index_filter');
//免费广告位
Route::get('/free-ads','AdSpaceController@free');
Route::get('/getcaptcha','GetCaptchaController@get_captcha');
