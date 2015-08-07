<?php namespace App\Models;
use Session;
/**
 * Provide functions for validation and registry a tel.
 *
 * @author Yuez
 **/
class ValiCodeRepository {
  const VALI_CODE_KEY = 'message';

  /**
   * Generate a validation code 
   * and set the code into session.
   *
   * @return string of validation code
   **/
  public static function generateAndRegistry()
  {
    $valiCode = RandomHelper::randDigits();
    self::registry($valiCode);
    return $valiCode;
  }

  /**
   * Generate a validation code
   * registry it in session and
   * send the validation code to 
   * a specific telphone.
   *
   * @param $to telphone
   * @return whether send validation code success.
   **/
  public static function registryThenSendTo($to)
  {
    $code = self::generateAndRegistry();
    $repo = App::make('SMSRepository');
    return $repo->sendTemplateMessage($to, array($code, Config::get('sms.expired')), Config::get('sms.tempId'));
  }

  /**
   * Set validation code into session
   **/
  public static function registry($code)
  {
    Session::put(self::VALI_CODE_KEY, $code);
  }

  /**
   * Clear validation code from sessoin
   **/
  public static function destroy()
  {
    Session::forget(self::VALI_CODE_KEY);
  }

  /**
   * Authenticate supply validation code equals to code in SESSION. 
   *
   * @return whether authenticate
   **/
  public static function auth($code)
  {
    return Session::has(self::VALI_CODE_KEY) &&
      Session::get(self::VALI_CODE_KEY) == $code;
  }

  /**
   * Opposite of auth()
   *
   * @return whether not authenticate
   **/
  public static function fails($code)
  {
    return !self::auth($code);
  }
}
