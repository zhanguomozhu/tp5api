<?php 
namespace app\common\model;
use think\Model;
class Admin extends Model
{
	/**
	 * 多对多关联角色用户表
	 * @return [type] [description]
	 */
	public function groups()
    {
        return $this->belongsToMany('AuthGroup','AuthGroupAccess','group_id','uid');
    }



	/**
	 * 获取管理员列表
	 * @return [type] [description]
	 */
	public function getAdmin()
	{
		//获取管理员列表
		$admins = $this->paginate('',false,['query' => request()->param()]);
		foreach ($admins as $k1 => $v1) {
			//查询管理员属于什么角色
		    $access = model('AuthGroupAccess')->where(['uid'=>$v1['id']])->find();
		    if($access){
		    	//查询角色
			    $group = model('AuthGroup')->where(['id'=>$access['group_id']])->find();
			    $admins[$k1]['group'] = $group['title'];
		    }else{
		    	$admins[$k1]['group'] = '暂无角色';
		    }
		}
		return $admins;
	}


	/**
	 * 获取管理员
	 * @return [type] [description]
	 */
	public function getAdminOne($id)
	{
		//获取管理员列表
		$admin = $this->find($id);
		//查询管理员属于什么角色
	    $access = model('AuthGroupAccess')->where(['uid'=>$admin['id']])->find();
	    if($access){
	    	//查询角色
		    $group = model('AuthGroup')->where(['id'=>$access['group_id']])->find();
		    $admin['group'] = $group['title'];
	    }else{
	    	$admin['group'] = '暂无角色';
	    }
		return $admin;
	}


	/**
	 * 添加管理员
	 * @param [type] $data [description]
	 */
	public function addAdmin($data)
	{
		//判断是否存在数据
		if(empty($data) || !is_array($data)){
			return false;
		}else{
			//加密密码
			if($data['password']){
				$data['password'] = md5($data['password']);
			}
			//插入数据库
			if($this->allowField(true)->save($data)){
				//添加角色管理员表，group——access
				//如果角色id大于0,插入用户角色表，attach跟save都可以
				if($data['group_id']){
					$this->groups()->save($data['group_id']);
				}
				return $this->id;//返回自增id
			}else{
				return false;
			}
		}
	}


	/**
	 * 删除管理员
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function delAdmin($id)
	{
		//先删除用户角色表数据
		$res = model('AuthGroupAccess')->where(['uid'=>$id])->delete();
		if($res){
			if($this::destroy($id)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
		
	}

	/**
	 * 修改账号
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function savePW($data){
		if(isset($data['group_id']) && !empty($data['group_id'])){
			//查找是否有用户角色数据
			$group = model('AuthGroupAccess')->find(['group_id'=>$data['group_id'],'uid'=>$data['id']]);
			if($group){//true
				//先编辑用户角色表数据
				$access = model('AuthGroupAccess')->save(['group_id'=>$data['group_id']],['uid'=>$data['id']]);
			}else{//false
				//插入用户角色表数据
				$access = model('AuthGroupAccess')->save(['uid'=>$data['id'],'group_id'=>$data['group_id']]);
			}
			if($access){
					if($this->doSave($data)){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
			
		}else{
			if($this->doSave($data)){
				return true;
			}else{
				return false;
			}
		}
	}

	/**
	 * 执行修改用户表
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	private function  doSave($data){
		$data['password'] = md5($data['password']);
		$res = $this->allowField(true)->save($data,['id'=>$data['id']]);
		return $res;
	}




	/**
	 * 登录方法
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public  function login($data)
	{
		$res = Admin::getByUsername($data['username']);
		if($res){
			if($res['password'] == md5($data['password'])){
				//存储session，session_id 用户标识，防止覆盖
				session(session_id().'_uid',$res['id'],'global');
				session(session_id().'_username',$res['username'],'global');

				return 2;//密码正确
			}else{
				return 3;//密码错误
			}
		}else{
			return 1;//用户不存在
		}
		
	}


	/**
	 * 注册
	 * @param [type] $data [description]
	 */
	public function register($data)
	{
		//判断是否存在数据
		if(empty($data) || !is_array($data)){
			return false;
		}else{
			//加密密码
			if($data['password']){
				$data['password'] = md5($data['password']);
			}
			//插入数据库
			if($this->allowField(true)->save($data)){
				//存入session  session_id 用户标识，防止覆盖
				session(session_id().'_uid',$this->id,'global');
				session(session_id().'_username',$data['username'],'global');
				return $this->id;//返回自增id
			}else{
				return false;
			}
		}
	}




}