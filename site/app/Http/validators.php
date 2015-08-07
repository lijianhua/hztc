<?php
Validator::extend('phonecode', function($attribute, $value, $parameters)
{
  return App\Models\ValiCodeRepository::auth($value);
});

/**
 * 验证是否为手机号码
 **/
Validator::extend('tel', function($attribute, $value, $parameters)
{
  return preg_match('/\d{11}/', $value);
});

