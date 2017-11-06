<?php
// +----------------------------------------------------------------------
// | LTHINK [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2017 http://www.mymkj.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Taoge <liangtao.gz@foxmail.com>
// +----------------------------------------------------------------------
namespace app\user\controller;

use think\Controller;
use lt\ThinkSDK\ThinkOauth;
use app\user\event\TypeEvent;

/**
 * 第三方登录控制器
 * 登录及回调的入口
 */
class Oauth extends Controller
{
    //登录地址
    public function login($type = null)
    {
        empty($type) && $this->error('参数错误');
        //加载ThinkOauth类并实例化一个对象
        $sns = ThinkOauth::getInstance($type);
        //跳转到授权页面
        $this->redirect($sns->getRequestCodeURL());
    }

    //授权回调地址
    public function callback($type = null, $code = null)
    {
        //支付宝code
        if ('alipay' == $type) {
            $code = $_GET['auth_code'];
        }
        (empty($type) || empty($code)) && $this->error('参数错误');

        //加载ThinkOauth类并实例化一个对象
        $sns = ThinkOauth::getInstance($type);

        //腾讯微博需传递的额外参数
        $extend = null;
        if ($type == 'tencent') {
            $extend = array('openid' => $this->_get('openid'), 'openkey' => $this->_get('openkey'));
        }

        //请妥善保管这里获取到的Token信息，方便以后API调用
        //调用方法，实例化SDK对象的时候直接作为构造函数的第二个参数传入
        //如： $qq = ThinkOauth::getInstance('qq', $token);
        $token = $sns->getAccessToken($code, $extend);
        //获取当前登录用户信息
        if (is_array($token)) {
            $TypeEven = new TypeEvent();
            $result = $TypeEven->$type($token);
            if ($result === true) {
                $this->success("恭喜！使用{$type}用户登录成功！", 'center/index');
                //$this->redirect('center/index');
            } else {
                $this->error($result);
            }
        }
    }

}
