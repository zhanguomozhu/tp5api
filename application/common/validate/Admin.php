<?php
namespace app\common\validate;
use think\Validate;
class Admin extends Validate
{
	//验证规则
	protected  $rule = [
		'username'   => 'require|unique:admin|length:4,18',
        'password'   => 'require|length:4,18',
        'password1'  => 'require|confirm:password',
        'phone'      => 'number|checkPhone:phone',
	];
	//验证提示
	 protected $message  =   [
        'username.require'  => '用户名必须填写',
        'username.unique'   => '用户名不能重复',
        'username.length'   => '用户名在4-25个字符',
        'password.require'  => '密码必须填写',
        'password.length'   => '密码在4-25个字符',
        'password1.require' => '确认密码必须填写',
        'password1.confirm' => '确认密码必须和密码一致',
        'phone.number'      => '手机号必须是数字',   
        'phone.checkPhone'  => '手机号格式不正确',   
    ];
    //验证场景
    protected $scene = [
        'login'     =>  ['username','password'],//登录
        'register'  =>  ['username','password','password1','phone'],//注册
        'change'    =>  ['username.require','username.length','password','phone'],//修改
        'add'       =>  ['username','password','phone'],//添加账号
    ];


    // 自定义验证规则
    // 验证数据
    // 验证规则
    // 全部数据（数组）
    // 字段名
    // 字段描述
    protected function checkPhone($value,$rule,$data)
    {

        if(preg_match("/^1[34578]\d{9}$/", $value)){
            return $rule = true;
        }else{
            return $rule = '手机号格式不正确';
        }
    }
    
}