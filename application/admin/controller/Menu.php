<?php 
namespace app\admin\controller;
use app\base\controller\Base;
use think\Loader;
class Menu extends Base
{
	/**
	 * 列表
	 * @return [type] [description]
	 */
	public function lst(){
		//排序
		if(request()->isPost()){
			$data = input('post.');
			foreach ($data as $key => $value) {
				model('Menu')->editAll(['id' => $key, 'sort' => $value],true);
			}
			$this->success('排序成功','lst');
			return;
		}
		$menus = model('Menu')->trees();
		return $this->fetch('',['menus'=>$menus]);
	}



	/**
	 * 添加
	 * @return [type] [description]
	 */
	public function add(){
		if(request()->isPost()){
			//数据库字段 网页字段转换，过滤参数
            $param = [
            	'title' =>'title',
                'path' 	=> 'path',
                'pid' 	=> 'pid',
                'status'=> 'status',
                'icon'	=> 'icon',
            ];
            $param_data = $this->buildParam($param);
            
            //实例化验证器
    		$validate = Loader::validate('Menu');
    		//验证
    		if (!$validate->scene('add')->check($param_data)) {
    			return $this->error($validate->getError());
    		}

    		//加入数据库
			$res = model('Menu')->addAll($param_data);
			if($res){
				$this->success('添加菜单成功','lst');
			}else{
				$this->error('添加菜单失败');
			}
			return;

		}
		$menus = model('Menu')->trees();
		return $this->fetch('',['menus'=>$menus]);
	}



	/**
	 * 编辑
	 * @return [type] [description]
	 */
	public function edit(){
		if(request()->isPost()){
			//数据库字段 网页字段转换，过滤参数
            $param = [
            	'id'    =>'id',
            	'title' =>'title',
                'path' 	=> 'path',
                'pid' 	=> 'pid',
                'status'=> 'status',
                'icon'	=> 'icon',
            ];

            $param_data = $this->buildParam($param);
            
            //实例化验证器
    		$validate = Loader::validate('Menu');
    		//验证
    		if (!$validate->scene('add')->check($param_data)) {
    			return $this->error($validate->getError());
    		}
    		//插入数据库
    		$res = model('Menu')->editAll($param_data);
			if($res){
				$this->success('更新成功','lst');
			}else{
				$this->error('更新失败');
			}
			return;
		}


		//菜单列表
		$menus = model('Menu')->trees();
		//获取单独菜单
		$menu = model('Menu')->find(input('id'));
		return $this->fetch('',['menus'=>$menus,'menu'=>$menu]);
	}


	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function del($id){
		if(isset($id) && !empty($id)){
			$res = model('Menu')->delAll(['id'=>$id]);
			if($res){
                $this->success('删除成功','lst');
            }else{
                $this->error('修改失败');
            }
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
           	$res = model('Menu')->editAll($param_data);
            if($res){
                $this->redirect($_SERVER['HTTP_REFERER']);
            }else{
                $this->error('修改失败');
            }
        }
	}




}
