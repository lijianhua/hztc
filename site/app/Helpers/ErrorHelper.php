<?php namespace App\Helpers;

class ErrorHelper  {

    protected $en_cn = Array('truthname' => '真实姓名', 'idcard' => '身份证号码', 'telphone' => '手机号', 'enterprise' => '从属公司');

    public  function str_en_cn($str)
    {
      $en_cn = $this->en_cn;
      $str_link='';
      foreach($en_cn as $key => $value) 
      {
        if( preg_match('/'.$key.'/',$str))
        {
          
       $str_link = $str_link.preg_replace('/'.$key.'/',$value, $str) ;
        }
      }
      return  $str_link;
    }
}
