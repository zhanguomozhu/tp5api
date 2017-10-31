<?php
namespace app\common\validate;
use think\Validate;
class AuthRule extends Validate
{
	//验证规则
	protected  $rule = [
		'pid'    => 'require',
        'title'  => 'require|length:4,18',
        'name'   => 'require',
        'status' => 'require',
	];
	//验证提示
	 protected $message  =   [
        'pid.require'   => '父级id必须填写',
        'title.require' => '标题必须填写',
        'title.length'  => '标题长度必须是4-18位',
        'name.require'  => '名称必须填写',
        'status.require'=> '状态必须填写',
        
    ];
    //验证场景
    protected $scene = [
        'add'     =>  ['pid','title','name','status'],//添加
        'edit'    =>  ['pid','title','name','status'],//修改
    ];



}