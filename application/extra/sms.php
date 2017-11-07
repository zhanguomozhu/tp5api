<?php

/**
 * 阿里大鱼短信配置类
 */

return [
	'alidayu'=>[
		//填写自己的appkey
		'appkey' 			=> "24674937",  
		//填写自己的secretKey
		'secretKey'			=>'c892f563c2a1e43e93a01d2d346241c6', 
		//填写自己的FreeSignName
		'freeSignName'		=>'me短信测试',
		//填写自己的模板id
		"smsTemplateCode" 	=> "SMS_107025099", 
	],
	'yun'=>[
		//填写自己的appId
		'appid' 			=> "64b405fd15e44b5590cf17d52f2002e0",  
		//填写自己的accountsid
		'accountsid'		=>'17fef39499570514068fb9ea4724f95c', 
		//填写自己的token
		'token'				=>'a53dcd9c5d676d018b9bb8b74b87251f',
		//填写自己的模板id
		"templateid" 		=> "43083", 
	],
	'rong'=>[
		//主帐号,对应开官网发者主账号下的 ACCOUNT SID
		'accountSid' 		=> '8aaf07085c346c5a015c3dafbd710380',
		//主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
		'accountToken'		=>'615f14d571f948e78587d5107fe85304',
		//应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
		//在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
		'appId'				=>'8aaf07085c346c5a015c3dafc3b80385',
		//请求地址
		//沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
		//生产环境（用户应用上线使用）：app.cloopen.com
		'serverIP'			=>'app.cloopen.com',
		//请求端口，生产环境和沙盒环境一致
		'serverPort'		=>'8883',
		//REST版本号，在官网文档REST介绍中获得。
		'softVersion'		=>'2013-12-26',
	],
	

];