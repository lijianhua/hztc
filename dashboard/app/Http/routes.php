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
  Route::delete('slides/{slide_id}/slide-items/{id}', 'SlideItemController@destroy');
  Route::post('slide-items', 'SlideItemController@store');
  Route::put('slides/{slide_id}/slide-items/{id}', 'SlideItemController@update');

  // 广告分类管理
  Route::get('ad-categories', 'AdCategoryController@index');
  Route::get('ad-categories/server-proccessing', 'AdCategoryController@server');
  Route::delete('ad-categories/{id}', 'AdCategoryController@destroy');
  Route::get('ad-categories/roots', 'AdCategoryController@roots');
  Route::put('ad-categories/{id}', 'AdCategoryController@update');
  Route::post('ad-categories', 'AdCategoryController@store');

  // 分类中心管理
  Route::resource('ad-centers', 'AdCenterController');

  // 需要验证是当前用户
  Route::group(['middleware' => 'verifyCurrentUser'], function () {
    // 用户账户管理
    Route::get('accounts/{id}', 'AccountController@show');
    Route::get('accounts/{id}/edit', 'AccountController@edit');
    Route::put('accounts/{id}/reset-password', 'AccountController@postResetPassword');
    Route::put('accounts/{id}/edit', 'AccountController@update');
    Route::put('accounts/{id}/enterprise', 'AccountController@updateEnterprise');

  });

  // 管理员管理
  Route::get('admins', 'AdminController@index');
  Route::get('admins/server', 'AdminController@server');
  Route::put('admins/{id}/appointed', 'AdminController@appointed');
  Route::put('admins/{id}/unappointed', 'AdminController@unappointed');

  // 广告管理
  Route::get('ads', 'AdSpaceController@index');
  Route::get('ads/server-proccessing', 'AdSpaceController@server');

  Route::get('ads/waiting-audited', 'AdSpaceController@getWaitingAudited');
  Route::get('ads/waiting-audited-server-proccessing', 'AdSpaceController@waitingAuditedServer');

  Route::get('ads/{id}', 'AdSpaceController@show');
  Route::delete('ads/{id}', 'AdSpaceController@destroy');

  Route::get('ad-spaces/{id}/edit', 'AdSpaceController@edit');
  Route::get('ads/{id}/edit-information', 'AdSpaceController@getEditInformation');
  Route::put('ads/{id}', 'AdSpaceController@update');

  Route::put('ads/{id}/audit', 'AdSpaceController@audit');

  Route::get('ad-spaces/create', 'AdSpaceController@create');
  Route::post('ad-spaces/create', 'AdSpaceController@store');

  //用户管理
  Route::get('users/create', 'UserController@create');
  Route::post('users/create', 'UserController@store');
  Route::delete('users/{id}', 'UserController@destroy');
  Route::get('users/{id}/edit', 'UserController@edit');
  Route::put('users/{id}', 'UserController@update');

  // 图片上传
  Route::any('avatars/upload', 'ImageController@store');
  Route::any('avatars/delete/{id}', 'ImageController@destroy');
  Route::any('ckeditor/upload', 'ImageController@ckeditor');

  // 三级地址获取
  Route::get('addresses', 'AddressController@index');

  // 订单管理
  Route::get('orders', 'OrderController@index');
  Route::get('orders/server-proccessing', 'OrderController@server');
  Route::get('orders/pending-proccess', 'OrderController@pending');
  Route::get('orders/server-pending', 'OrderController@pendingServer');
  Route::put('orders/proccessing/{id}', 'OrderController@proccess');
  Route::put('orders/confirm/{id}', 'OrderController@confirm');
  Route::get('orders/newest', 'OrderController@newest');
  Route::get('orders/server-newest', 'OrderController@newestServer');
  Route::get('orders/{id}', 'OrderController@show');
  Route::put('orders/{id}/status', ['as' => 'orders.status.patch', 'uses' => 'OrderController@changeStatus']);

  // 客户退单
  Route::get('refunds', 'RefundController@index');
  Route::get('refunds/server-proccessing', 'RefundController@server');
  Route::get('refunds/pending-proccess', 'RefundController@pending');
  Route::get('refunds/server-pending', 'RefundController@pendingServer');
  Route::get('refunds/underway', 'RefundController@underway');
  Route::get('refunds/server-underway', 'RefundController@underwayServer');
  Route::put('refunds/{id}/aggree', 'RefundController@aggree');
  Route::put('refunds/{id}/refuse', 'RefundController@refuse');
  Route::put('refunds/{id}/finish', 'RefundController@finish');
  Route::get('refunds/{id}', 'RefundController@show');

  // 用户、企业审核
  Route::get('users/pending-verify', 'UserController@pending');
  Route::get('users/server-pending-verify', 'UserController@pendingServer');
  Route::put('users/{id}/aggree', 'UserController@aggree');
  Route::put('users/{id}/refuse', 'UserController@refuse');

  Route::get('enterprises/pending-verify', 'EnterpriseController@pending');
  Route::get('enterprises/server-pending-verify', 'EnterpriseController@pendingServer');
  Route::put('enterprises/{id}/aggree', 'EnterpriseController@aggree');
  Route::put('enterprises/{id}/refuse', 'EnterpriseController@refuse');

  // 秒杀活动
  Route::get('promotions/create', 'PromotionController@create');
  Route::post('promotions', 'PromotionController@store');
  Route::get('promotions', 'PromotionController@index');
  Route::get('promotions/server-proccessing', 'PromotionController@proccessingServer');
  Route::get('promotions/server', 'PromotionController@server');
  Route::get('promotions/proccessing', 'PromotionController@proccessing');
  Route::delete('promotions/{id}', 'PromotionController@destroy');
  Route::put('promotions/{id}', 'PromotionController@update');
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
