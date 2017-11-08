<?php 
namespace app\admin\controller;
use app\base\controller\Base;
use app\common\model\Conf as ConfModel;
use think\Loader;
use think\Request;
class Conf extends Base
{
	/**
	 * 配置列表
	 * @return [type] [description]
	 */
	public function lst()
	{
		if(request()->isPost()){
			$data = input('post.');
			foreach ($data as $key => $value) {
				model('conf')->saveConf(['id' => $key, 'sort' => $value]);
			}
			$this->success('排序成功','lst');
			return;
		}
		$confs = model('conf')->getList();
		return $this->fetch('',['confs'=>$confs]);
	}

	/**
	 * 添加配置项
	 */
	public function add()
	{
		if(request()->isPost()){
			$data = input('post.');
			//验证
			$validate = Loader::validate('Conf');
			if(!$validate->check($data)){
			    $this->error($validate->getError());
			}
			if($data['values']){
				$data['values'] = str_replace('，',',',$data['values']);
			}
			//插入数据库
			$res = model('conf')->addConf($data);
			if($res){
				$this->success('添加成功','lst');
			}else{
				$this->error('添加失败');
			}
			return;
		}

		return $this->fetch();
	}

	/**
	 * 编辑配置
	 * @return [type] [description]
	 */
	public function edit()
	{
		if(request()->isPost()){
			$data = input('post.');
			//验证
			$validate = Loader::validate('Conf');
			if(!$validate->scene('edit')->check($data)){
			    $this->error($validate->getError());
			}
			if($data['values']){
				$data['values'] = str_replace('，',',',$data['values']);
			}
			//修改数据
			$res = model('conf')->saveConf($data);
			if($res){
				$this->success('更新成功','lst');
			}else{
				$this->error('更新失败');
			}
			return;
		}
		
		$conf = model('conf')->find(input('id'));
		return $this->fetch('',['res'=>$conf]);
	}


	/**
	 * 删除配置
	 * @return [type] [description]
	 */
	public function del()
	{
		$data = model('conf')->delConf(['id'=>input('id')]);
		if($data){
				$this->success('删除成功','lst');
			}else{
				$this->error('删除失败');
			}
		return view();
	}



	/**
	 * 配置项
	 * @return [type] [description]
	 */
	public function conf()
	{
		if(request()->isPost()){
			$data = input('post.');
			//获取所有健集合
			$data_keys = array_keys($data);
			//查找数据库所有配置项
			$_confarr = model('conf')->field('enname')->select();
			$confs =array();
			//获取数据库所有enname字段	
			foreach ($_confarr as $k => $v) {
				$confs[] = $v['enname'];
			}
			//获取上传字段与数据库字段差集
			$row = array_diff($confs,$data_keys);
			foreach ($row as $k1 => $v1) {
				$data[$v1] = '否';//把复选框字段设置为否
			}
			if($data){
				foreach ($data as $key => $value) {
					//修改配置
					model('conf')->where('enname',$key)->update(['value' => trim($value)]);
				}
			}
			$this->success('修改配置成功');
			return;
		}
		//获取配置信息
		$res = model('conf')->select();
		//去除空格
		foreach ($res as $key => $value) {
			$res[$key]['values'] = trim($res[$key]['values']);
		}
		return $this->fetch('',['data'=>$res]);
	}

}
