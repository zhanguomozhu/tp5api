<?php 
namespace app\common\model;
use app\base\model\Base;
use think\Db;
class Menu extends Base
{


	/**
	 *	条件查询
	 * @return [type] [description]
	 */
	public function findAll($data=[]){
		$res = $this->findData($data);
		if($res){
			return $res;
		}else{
			return false;
		}
	}


	/**
	 *	添加
	 * @return [type] [description]
	 */
	public function addAll($data){
		//获取父级级别
		$parent = $this->find(['pid'=>$data['pid']]);
		if($parent){
			$data['level'] = $parent['level']+1;
		}else{
			$data['level'] = 0;
		}
		//状态
		if(!isset($data['status'])){
			$data['status'] = 0;
		}
		$res = $this->addData($data);
		if($res){
			return $res;
		}else{
			return false;
		}
	}


	/**
	 *	编辑
	 * @return [type] [description]
	 */
	public function editAll($data,$order=0){
		//是否排序
		if(!$order){
			if(isset($data['pid'])){
				//获取父级级别
				$parent = $this->find(['pid'=>$data['pid']]);
				if($parent){
					$data['level'] = $parent['level']+1;
				}else{
					$data['level'] = 0;
				}
			}
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
	 *	删除
	 * @return [type] [description]
	 */
	public function delAll($data){
		if(isset($data['id'])){
			//判断此id有没有下级菜单
			$arr = $this->get_son($data['id']);
			if($arr){
				//删除子级菜单
				$res = $this::destroy($arr);
				//删除自身
				$res = $this::destroy($data['id']);
			}else{
				$res = $this->delData($data);
			}
		}else{
			$res = $this->delData($data);
		}
		
		
		if($res){
			return $res;
		}else{
			return false;
		}
	}


	/**
	 * 获取无限极分类树
	 * @return [type] [description]
	 */
	public function trees(){
		$res = $this->getTree();
		if($res){
			return $res;
		}else{
			return false;
		}
	}




	/**
	 * 获取左侧菜单排序,无极限分类
	 * @param  [type] $items [description]
	 * @return [type]        [description]
	 */
	public function getLeft(){
		$items = Db::table('tp_menu')->field('id,title,path,pid,icon')->where(['status'=>1])->order('sort asc')->select();
	    $trees = array();
	    //把数组主键ID重写到外层下标
	    foreach($items as $k => $item){
	    	$trees[$item['id']]=$item;
	    }
	    //组件树形
	    $data = array();
	    foreach($trees as $k => $tree){
	        if(isset($trees[$tree['pid']])){
	            $trees[$tree['pid']]['son'][] = &$trees[$tree['id']];
	        }else{
	            $data[] = &$trees[$tree['id']];
	        }
	    }
	    return $data;
	}



}