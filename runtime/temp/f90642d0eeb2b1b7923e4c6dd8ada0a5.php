<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\phpStudy\WWW\tp5api\public/../application/index\view\index\index.html";i:1509933983;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>第三方登录</title>
</head>
<body>
	<ul>
		<li><a href="<?php echo url('user/oauth/login',['type'=>'qq']); ?>">腾讯QQ用户登录</a></li>
		<li><a href="<?php echo url('user/oauth/login',['type'=>'tencent']); ?>">腾讯微博用户登录</a></li>
		<li><a href="<?php echo url('user/oauth/login',['type'=>'sina']); ?>">新浪微博用户登录</a></li>
		<li><a href="<?php echo url('user/oauth/login',['type'=>'t163']); ?>">网易微博用户登录</a></li>
		<li><a href="<?php echo url('user/oauth/login',['type'=>'renren']); ?>">人人网用户登录</a></li>
		<li><a href="<?php echo url('user/oauth/login',['type'=>'x360']); ?>">360用户登录</a></li>
		<li><a href="<?php echo url('user/oauth/login',['type'=>'douban']); ?>">豆瓣用户登录</a></li>
		<li><a href="<?php echo url('user/oauth/login',['type'=>'github']); ?>">Github用户登录</a></li>
		<li><a href="<?php echo url('user/oauth/login',['type'=>'google']); ?>">Google用户登录</a></li>
		<li><a href="<?php echo url('user/oauth/login',['type'=>'msn']); ?>">MSN用户登录</a></li>
		<li><a href="<?php echo url('user/oauth/login',['type'=>'diandian']); ?>">点点用户登录</a></li>
		<li><a href="<?php echo url('user/oauth/login',['type'=>'taobao']); ?>">淘宝网用户登录</a></li>
		<li><a href="<?php echo url('user/oauth/login',['type'=>'baidu']); ?>">百度用户登录</a></li>
		<li><a href="<?php echo url('user/oauth/login',['type'=>'kaixin']); ?>">开心网用户登录</a></li>
		<li><a href="<?php echo url('user/oauth/login',['type'=>'sohu']); ?>">搜狐微博用户登录</a></li>
	</ul>
</body>
</html>