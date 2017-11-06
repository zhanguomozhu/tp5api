<?php 
namespace app\common\model;
use app\base\model\Base;
class Sns extends Base
{

	/**
	 * 添加
	*/
	public function addSns($data){
		if(isset($data) && !empty($data)){
			//插入数据库
			if($this->save($data)){
				return $this->id;
			}else{
				return flase;
			}
		}else{
			return false;
		}
	}
}