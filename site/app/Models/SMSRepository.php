<?php namespace App\Models;
use App\Models\REST;
use Config;
/**
 * Send messages service throught yuntongxun.com
 **/
class SMSRepository
{
  /**
   * 通过yuntongxun.com发送短信
   *
   * @return 发送是否成功
   * @author Yuez
   **/
  public function sendTemplateMessage($to, $data, $tempId)
  {
    // Initialize Rest api
    $rest = new REST(Config::get('sms.host'), Config::get('sms.port'), Config::get('sms.version'));
    $rest->setAccount(Config::get('sms.accountId'), Config::get('sms.token'));
    $rest->setAppId(Config::get('sms.appId'));
    // Send message.
    $result = $rest->sendTemplateSMS($to, $data, $tempId);
    print_r($result);
    exit;
    return $result && $result->statusCode == 0;
  }

  /**
   *
   **/
  public function sendTemplateMessageByOtherPlatform($to, $data)
  {
    $url='http://utf8.sms.webchinese.cn/?Uid=lijie54&Key=9cc0c325648e812364ec&smsMob=' . $to . '&smsText=' . $data;

    if (function_exists('file_get_contents')) {
      $result = file_get_contents($url);
    } else {
      $ch = curl_init();
      $timeout = 5;
      curl_setopt ($ch, CURLOPT_URL, $url);
      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
      $result = curl_exec($ch);
      curl_close($ch);
    }
    return $result;
  }

  /**
   * 发送用户获得积分短信
   *
   * @return 短信是否发送成功
   * @author Yuez
   **/
  public function sendScoreGainedMessage($to, $data)
  {
    $tempId = Config::get('sms.scoreGainId');
    return $this->sendTemplateMessage($to, $data, $tempId);
  }

  /**
   * 发送消费积分的短信
   * Enter description here ...
   */
  public function sendScoreConsumeMessage($to, $data)
  {
    $tempId = Config::get('sms.scoreConsumeId');
    return $this->sendTemplateMessage($to, $data, $tempId);
  }
}
