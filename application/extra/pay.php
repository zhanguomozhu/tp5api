<?php

return [
    // 微信支付参数
    'wechat' => [
        'app_id'     => 'wx426b3015555a46be', // 应用ID
        'mch_id'     => '1900009851', // 微信支付商户号
        'mch_key'    => '8934e7d15453e97507ef794cf7b0519d', // 微信支付密钥
        'mch_appsecret'    => '7813490da6f1265e4901ffb80afaa36f', // 公众帐号secert（仅JSAPI支付的时候需要配置， 登录公众平台，进入开发者中心可设置）
        'ssl_cer'    => EXTEND_PATH.'wx/cert/apiclient_cert.pem', // 微信证书 cert 文件
        'ssl_key'    => EXTEND_PATH.'wx/cert/apiclient_key.pem', // 微信证书 key 文件
        'notify_url' => 'http://tp5api.com/index/wxpay/notify', // 支付通知URL
    ],
    // 支付宝支付参数
    'alipay' => [
        'app_id'      => '', // 应用ID
        'public_key'  => '', // 支付宝公钥(1行填写)
        'private_key' => '', // 支付宝私钥(1行填写)
        'notify_url'  => 'http://tp5api.com/index/alipay/notify', // 支付通知URL
    ]
];