<?php
return [

	// 安全检验码，以数字和字母组成的32位字符。
	'key' => 'meq6h62l87kqty0w8g9xa8in25kr019e',

	//签名方式
	'sign_type' => 'MD5',

	// 服务器异步通知页面路径。
	'notify_url' => 'http://localhost:8000/alipay/notify',

	// 页面跳转同步通知页面路径。
	'return_url' => 'http://localhost:8000/alipay/return'
];
