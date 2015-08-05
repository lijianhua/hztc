<?php

/**
 * yuntongxun.com SMS api configuration.
 *
 * Typical, the request url follow as this
 * /{SoftVersion}/Accounts/{accountSid}/{func}/{funcdes}?sig={SigParameter}
 **/
return array(
  /**
   * Development environment url.
   * In production environment, the url is 
   * https://app.cloopen.com:8883
   * Do <em>NOT FORGET</em> to replace it with production url
   * when this application get to run as production.
   **/
  'host' => 'app.cloopen.com',
  //'host' => 'sandboxapp.cloopen.com',

  /**
   * Port of yuntongxun.com service api
   **/
  'port' => '8883',

  /**
   * Fixture value
   **/
  'version' => '2013-12-26',

  /**
   * yuntongxun.com account id
   **/
  'accountId' => '8a48b5514e3e5862014e4daffd900e71',

  /**
   * Authentication token
   **/
  'token' => 'b6704649edff458392bd066070b95112',

  /**
   * Identity of the yuntongxun.com application
   * It's demo application now, you shoud replace it
   * with 8a48b551488d07a801489a435c6703aa in production evironment.
   **/
  'appId' => 'aaf98f894e3e5b81014e4db1e2e20f73',

  /**
   * 1 is test template id.
   * This should be replace with the template id that you supplier
   * at yuntongxun.com in production evironment.
   **/
  'tempId' => '27854',

  /**
   * 用户获取积分后的短信模板id
   **/
  'scoreGainId' => '8231',

  /**
   * 用户消费积分发送短信的模板Id
   */
  'scoreConsumeId' => '8122',

  /**
   * Expired in minutes.
   **/
  'expired' => '10',
);
