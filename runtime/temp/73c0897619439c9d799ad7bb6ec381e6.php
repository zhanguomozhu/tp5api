<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\phpStudy\WWW\tp5api\public/../application/index\view\alipay\index.html";i:1509781564;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>支付宝支付</title>
</head>
<body>
	<a href="<?php echo url('alipay/web'); ?>">支付宝电脑支付</a>
	<a href="<?php echo url('alipay/wap'); ?>">支付宝手机网站支付</a>
	<a href="<?php echo url('alipay/app'); ?>">支付宝APP 支付</a>
	<a href="<?php echo url('alipay/pos'); ?>">支付宝刷卡支付</a>
	<a href="<?php echo url('alipay/scan'); ?>">支付宝扫码支付</a>
	<a href="<?php echo url('alipay/transfer'); ?>">支付宝帐户转账</a>
</body>
</html>