<?php 
namespace app\common\model;
use app\base\model\Base;
class AuthGroupAccess extends Base
{

	/**
	 * 一对一关联查询角色表
	 * @return [type] [description]
	 */
	public function groups()
    {
        return $this->belongsTo('AuthGroup','group_id','id');
    }


    /**
	 * 一对一关联查询用户表
	 * @return [type] [description]
	 */
	public function admins()
    {
        return $this->belongsTo('Admin','uid','id');
    }

    /**
     * 获取角色权限
     * @return [type] [description]
     */
    public function getAuths($id){
    	//获取权限id
    	$data = $this->with(['admins', 'groups'])->where('uid',$id)->find()->visible(['groups.rules'])->toArray();
    	$res = explode(',',$data['groups']['rules']);
    	return $res;
    }
}