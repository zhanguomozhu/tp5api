<?php 
namespace app\common\validate;
use think\Validate;

class Conf extends Validate
{
	 protected $rule =   [
        'cnname'  => 'unique:conf|require|max:25',
        'enname'  => 'unique:conf|require|max:25',
        'type'    => 'require',
    ];
    
    protected $message  =   [
        'cnname.require' => '中文名称必须填写',
        'cnname.max'     => '中文名称最多不能超过25个字符',
        'cnname.unique'  => '中文名称不能重复',
        'enname.require' => '英文名称必须填写',
        'enname.max'     => '英文名称最多不能超过25个字符',
        'enname.unique'  => '英文名称不能重复',
        'type.require'   => '配置类型必须填写',
    ];


    protected $scene = [
         'add'   =>  ['cnname','enname','type'],
         'edit'  =>  ['cnname','enname','type'],
    ];
}