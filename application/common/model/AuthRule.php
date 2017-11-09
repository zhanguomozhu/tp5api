<?php 
namespace app\common\model;
use app\base\model\Base;

class AuthRule extends Base
{

	/**
	 * 权限列表
	 * @return [type] [description]
	 */
	public function getRule(){
		$rules = $this->getTree();
		return $rules;
	}



	/**
	 * 添加
	*/
	public function addRule($data){
		if(isset($data) && !empty($data)){
			//获取父级级别
			$parent = $this->find(['pid'=>$data['pid']]);
			if($parent){
				$data['level'] = $parent['level']+1;
			}else{
				$data['level'] = 0;
			}
			//插入数据库
			if($this->save($data)){
				return true;
			}else{
				return flase;
			}
		}else{
			return false;
		}
	}




	/**
	 *	编辑
	 * @return [type] [description]
	 */
	public function editAll($data,$order=0){

		//是否是排序
		if(!$order){
			//状态
			if(!isset($data['status'])){
				$data['status'] = 0;
			}
		}
		$res = $this->saveData($data);
		if($res){
			return $res;
		}else{
			return false;
		}
	}


	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function delRule($id)
	{
		if(isset($id)){
			//判断此id有没有下级权限
			$arr = $this->get_son($id);
			if($arr){
				//删除子级权限
				$res = $this::destroy($arr);
				//删除自身
				$res = $this::destroy($id);
			}else{
				$res = $this::destroy($id);
			}

			//删除权限表
			if($res){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}


	/**
	 * 获取角色权限列表
	 * @return [type] [description]
	 */
	public function getRuleTree()
	{
		$rules = $this->order('sort desc')->select();
		return $this->sortTree($rules);
	}

	/**
	 * tree排序
	 * @param  [type]  $data [description]
	 * @param  integer $pid  [description]
	 * @return [type]        [description]
	 */
	public function sortTree($data,$pid=0)
	{
		static $arr = array();
		foreach ($data as $k => $v) {
			if($v['pid'] == $pid){
				$v['dataid'] = $this->get_parent1($v['id']);
				$arr[] = $v;
				$this->sortTree($data,$v['id']);
			}
		}
		return $arr;
	}



	/**
	 * 获取父级树
	 * @param  [type] $rule_id [description]
	 * @return [type]          [description]
	 */
	// public  function get_parent($rule_id)
	// {
	// 	$rule_data = $this->select();
	// 	return $this->_get_parent($rule_data,$rule_id);
	// }

	/**
	 * 父级树排序
	 * @param  [type] $data    [description]
	 * @param  [type] $rule_id [description]
	 * @return [type]          [description]
	 */
	// public function _get_parent($data,$rule_id)
	// {	
	// 	static $arr = array();
	// 	foreach ($data as $key => $value) {
	// 		if($value['id'] == $rule_id){
	// 			$arr[] = $value['id'];
	// 			$this->_get_parent($data,$value['pid']);
	// 		}
	// 	}
	// 	return $arr;
	// }


	/**
	 * 获取父级树
	 * @param  [type] $rule_id [description]
	 * @return [type]          [description]
	 */
	public  function get_parent1($rule_id)
	{
		$rule_data = $this->select();
		return $this->_get_parent1($rule_data,$rule_id,TRUE);
	}

	/**
	 * 父级树排序
	 * @param  [type] $data    [description]
	 * @param  [type] $rule_id [description]
	 * @return [type]          [description]
	 */
	public function _get_parent1($data,$rule_id,$clear = false)
	{	
		static $arr = array();
		if($clear){
			$arr = array();
		}
		foreach ($data as $key => $value) {
			if($value['id'] == $rule_id){
				$arr[] = $value['id'];
				$this->_get_parent1($data,$value['pid'],false);
			}
		}
		asort($arr);//从小到大排序
		$arr1 = implode('-',$arr);
		return $arr1;
	}


}