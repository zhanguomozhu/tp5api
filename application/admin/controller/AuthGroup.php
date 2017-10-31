<?php 
namespace app\admin\controller;
use app\base\controller\Base;
use think\Loader;
class AuthGroup extends Base
{
	/**
	 * 列表
	 * @return [type] [description]
	 */
	public function lst()
	{
		//管理员列表
		$groups = model('AuthGroup')->getGroups();
		return $this->fetch('',['groups'=>$groups]);
	}



	/**
	 * 添加
	 */
	public function add()
	{
		if(request()->isPost()){
			$data = input('post.');
			//拼接权限id
			if(isset($data['rules'])){
				$data['rules'] = implode(',', $data['rules']);
			}else{
				$data['rules'] = '';
			}
			//角色状态
			if(!isset($data['status'])){
				$data['status'] = 0;
			}
            //插入数据库
            $res = model('AuthGroup')->addGroup($data);

			if($res){
				$this->success('添加成功','lst');
			}else{
				$this->error('添加失败');
			}
			return;
		}
		//角色权限
		$rules = model('AuthRule')->getRuleTree();
		return $this->fetch('',['rules'=>$rules]);
	}



	/**
	 * 修改
	 * @return [type] [description]
	 */
	public function edit()
	{
		
		if(request()->isPost()){
			
			$data = input('post.');
			//拼接权限id
			if(isset($data['rules'])){
				$data['rules'] = implode(',', $data['rules']);
			}else{
				$data['rules'] = '';
			}
			//角色状态
			if(!isset($data['status'])){
				$data['status'] = 0;
			}
			//dump($data);die;
			$res = model('AuthGroup')->saveGroup($data);
			if($res){
				$this->success('更新成功','lst');
			}else{
				$this->error('更新失败');
			}
			return;
		}
		
		//角色信息
		$res = model('AuthGroup')->getGroupOne(['id'=>input('id')]);
		//权限信息
		$rules = model('AuthRule')->getRuleTree();
		return $this->fetch('',['rules'=>$rules,'res'=>$res]);
	} 


	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function del($id)
	{
		$res = model('AuthGroup')->delGroup($id);
		if($res){
				$this->success('删除成功','lst');
			}else{
				$this->error('删除失败');
			}
	}



	/**
	 * 修改状态
	 * @return [type] [description]
	 */
	public function edit_status()
	{
		 if(request()->isGet()){
            //数据库字段 网页字段转换，过滤参数
            $param = [
            	'id' =>'id',
                'status' => 'status',
            ];
            $param_data = $this->buildParam($param);
            //提交数据
            if(model('AuthGroup')->save($param_data,['id'=>$param_data['id']])){
                $this->redirect($_SERVER['HTTP_REFERER']);
            }else{
                $this->error('修改失败');
            }
        }
	}

}