<?php

/**
 * 微信支付相关配置文件
 */

return [
	//绑定支付的APPID（开户邮件中可查看）
	'appid'=>'wx426b3015555a46be',
	//MCHID：商户号（开户邮件中可查看）
	'mchid'=>'1900009851',
	//KEY：商户支付密钥，参考开户邮件设置（登录商户平台自行设置）
	'key'=>'8934e7d15453e97507ef794cf7b0519d',
	//APPSECRET：公众帐号secert（仅JSAPI支付的时候需要配置
	'appsecret'=>'7813490da6f1265e4901ffb80afaa36f',
	//回调地址
	'notify_url'=>'/index/weixinpay/notify',


];