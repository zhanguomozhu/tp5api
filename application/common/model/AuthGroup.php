<?php 
namespace app\common\model;
use think\Model;
class AuthGroup extends Model
{
	
	
	/**
	 * 多对多关联角色用户表
	 * @return [type] [description]
	 */
	public function admins()
    {
        return $this->belongsToMany('Admin','AuthGroupAccess','uid','group_id');
    }

    /**
     * 状态获取器
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function getStatusAttr($value)
    {
        $status = [1=>'启用',0=>'禁用'];
        return $status[$value];
    }



    /**
     * 角色列表
     * @return [type] [description]
     */
    public function  getGroups(){
    	$groups = $this->paginate('',false,['query' => request()->param()]);
    	return $groups;
    }


    /**
     * 获取单独角色
     * @return [type] [description]
     */
    public function  getGroupOne($data=[]){
    	$group = $this->where($data)->find();
    	return $group;
    }



	/**
	 * 添加
	 */
	public function addGroup($data){
		if(isset($data) && !empty($data)){
			if($this->save($data)){
				return $this->id;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	/**
	 * 编辑
	 */
	public function saveGroup($data){
		if(isset($data) && !empty($data)){
			if($this->save($data,['id'=>$data['id']])){
				return $this->id;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}



	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function delGroup($id)
	{
		//删除角色用户表数据
		$access = model('AuthGroupAccess')->where(['group_id'=>$id])->delete();
		if($access){
			//删除角色表
			if($this::destroy($id)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
		
	}

}