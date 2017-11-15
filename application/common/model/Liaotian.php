<?php 
namespace app\common\model;
use app\base\model\Base;

class Liaotian extends Base
{


	public function addMsg($data){
		if(isset($data) && !empty($data)){
			$res = $this->addData($data);
			if($res){
				return $res;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}



}