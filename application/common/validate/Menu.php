<?php
namespace app\common\validate;
use think\Validate;
class Menu extends Validate
{
	//验证规则
	protected  $rule = [
		'pid'    => 'require',
        'title'  => 'require|length:4,50',
        'path'   => 'require',
	];
	//验证提示
	 protected $message  =   [
        'pid.require'   => '父级id必须填写',
        'title.require' => '标题必须填写',
        'title.length'  => '标题长度必须是4-18位',
        'path.require'  => '路径必须填写',
        
    ];
    //验证场景
    protected $scene = [
        'add'     =>  ['pid','title','path'],//添加
        'edit'    =>  ['pid','title','path'],//修改
    ];



}