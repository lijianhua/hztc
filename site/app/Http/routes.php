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
    Route::any('captcha-test', function()
        {
                if (Request::getMethod() == 'POST')
                {
                            $rules = ['captcha' => 'required|captcha'];
                            $validator = Validator::make(Input::all(), $rules);
                            if ($validator->fails())
                            {
                                              echo '<p style="color: #ff0000;">Incorrect!</p>';
                                                          }
                            else
                            {
                                              echo '<p style="color: #00ff30;">Matched :)</p>';
                                                          }
                        }
        
                $form = '<form method="post" action="captcha-test">';
                $form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                $form .= '<p>' . captcha_img() . '</p>';
                $form .= '<p><input type="text" name="captcha"></p>';
                $form .= '<p><button type="submit" name="check">Check</button></p>';
                $form .= '</form>';
                return $form;
            });
