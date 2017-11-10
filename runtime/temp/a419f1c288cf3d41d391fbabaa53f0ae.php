<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\phpStudy\WWW\tp5api\public/../application/index\view\wxpay\index.html";i:1509781673;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>微信支付</title>
</head>
<body>

	<a href="<?php echo url('wxpay/scan'); ?>">微信扫码支付</a>
	<a href="<?php echo url('wxpay/mp'); ?>">微信公众号支付</a>
	<a href="<?php echo url('wxpay/wap'); ?>">微信H5 支付</a>
	<a href="<?php echo url('wxpay/pos'); ?>">微信刷卡支付</a>
	<a href="<?php echo url('wxpay/app'); ?>">微信APP 支付</a>
	<a href="<?php echo url('wxpay/transfer'); ?>">微信企业付款</a>
	<a href="<?php echo url('wxpay/miniapp'); ?>">微信小程序支付</a>
	<a href="<?php echo url('wxpay/sendredpack'); ?>">微信公众号红包支付</a>
	<a href="<?php echo url('wxpay/mchpay'); ?>">微信企业付款</a>
</body>
</html>