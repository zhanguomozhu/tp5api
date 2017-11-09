<?php 
namespace app\admin\controller;
use app\base\controller\Base;
use think\Loader;
class AuthRule extends Base
{

	/**
	 * 权限列表
	 * @return [type] [description]
	 */
	public function lst()
	{
		//排序
		if(request()->isPost()){
			$data = input('post.');
			foreach ($data as $key => $value) {
				model('AuthRule')->editAll(['id' => $key, 'sort' => $value],true);
			}
			$this->success('排序成功','lst');
			return;
		}
		//权限列表
		$rules = model('AuthRule')->getRule();
		return $this->fetch('',['rules'=>$rules]);
	}

	public function add()
	{
		if(request()->isPost()){
			//数据库字段 网页字段转换，过滤参数
            $param = [
            	'pid' 	=>'pid',
                'title' => 'title',
                'name' 	=> 'name',
                'level' => 'level',
                'status'=> 'status',
            ];
            $param_data = $this->buildParam($param);
            //实例化验证器
    		$validate = Loader::validate('AuthRule');
    		//验证
    		if (!$validate->scene('add')->check($param_data)) {
    			return $this->error($validate->getError());
    		}
    		//插入数据库
    		$res = model('AuthRule')->addRule($param_data);

			if($res){
				$this->success('添加成功','lst');
			}else{
				$this->error('添加失败');
			}
			return;
		}
		//权限列表
		$rules = model('AuthRule')->getRule();
		return $this->fetch('',['rules'=>$rules]);
	}


	/**
	 * 编辑
	 * @return [type] [description]
	 */
	public function edit()
	{
		
		if(request()->isPost()){
			//数据库字段 网页字段转换，过滤参数
            $param = [
            	'id' 	=> 'id',
            	'pid' 	=> 'pid',
                'title' => 'title',
                'name' 	=> 'name',
                'level' => 'level',
                'status'=> 'status',
            ];
            $param_data = $this->buildParam($param);
            //实例化验证器
    		$validate = Loader::validate('AuthRule');
    		//验证
    		if (!$validate->scene('edit')->check($param_data)) {
    			return $this->error($validate->getError());
    		}
    		//插入数据库
    		$res = model('AuthRule')->editAll($param_data);
			if($res){
				$this->success('更新成功','lst');
			}else{
				$this->error('更新失败');
			}
			return;
		}
		//权限列表
		$rules = model('AuthRule')->getRule();
		//获取单独权限
		$rule = model('AuthRule')->find(input('id'));
		return $this->fetch('',['rules'=>$rules,'rule'=>$rule]);
	}



	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function del($id)
	{
		if(model('AuthRule')->delRule($id)){
			$this->success('删除成功','lst');
		}else{
			$this->error('修改失败');
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
           	$res = model('AuthRule')->editAll($param_data);
            if($res){
                $this->redirect($_SERVER['HTTP_REFERER']);
            }else{
                $this->error('修改失败');
            }
        }
	}

}