<?php
// +----------------------------------------------------------------------
// | LTHINK [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2017 http://www.mymkj.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Taoge <liangtao.gz@foxmail.com>
// +----------------------------------------------------------------------
namespace app\user\api;

use think\Controller;
use think\Db;

/**
 * 第三方登录控制器
 * 登录及回调的入口
 */
class UserApi extends Controller
{
	public function oauth($userinfo){
		
		if(isset($userinfo)){
			//判断数据库是否有此账号
			$openid = Db::table('tp_sns')->where(['openid'=>$userinfo['openid']])->find();
			if($openid){
				session('userinfo',$openid,'tp5');
				return true;
			}else{
				//插入数据库,获取id
				$res = model('sns')->addSns($userinfo);
				$userinfo['id'] = $res;
				//存入session
				session('userinfo',$userinfo,'tp5');
				if($res){
					return true;
				}else{
					return false;
				}
			}
            
		}else{
			return false;
		}
	}
}