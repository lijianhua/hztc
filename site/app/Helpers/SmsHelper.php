<?php namespace App\Helpers;
include_once("../SMS/Demo/SendTemplateSMS.php");
class SmsHelper  {

    public  function sendSMS($to, $datas, $tempId)
    {
        sendTemplateSMS($to,$datas,$tempId);
    }
}
$a = new SmsHelper();
$a->sendSMS('13120315753',array('hello', '1'),'1');
