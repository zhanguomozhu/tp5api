<?php 
namespace app\common\model;
use app\base\model\Base;

class Conf extends Base
{
	
	/**
	 * 获取配置列表
	 * @return [type] [description]
	 */
	public function getList(){
		return $this->order('sort')->paginate('',false,['query' => request()->param()]);
	}



	/**
	 * 编辑
	 * @return [type] [description]
	 */
	public function saveConf($data){
		return $this->saveData($data);
	}


	/**
	 * 添加
	 * @return [type] [description]
	 */
	public function addConf($data){
		return $this->addData($data);
	}


	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function delConf($data){
		return $this->delData($data);
	}
}