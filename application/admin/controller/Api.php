<?php 
namespace app\admin\controller;
use app\base\controller\Base;

class Api extends Base
{
	/**
	 * 快递
	 * @return [type] [description]
	 */
	public function express(){
		return $this->fetch();
	}

	/**
	 * 快递接口
	 * @return [type] [description]
	 */
	public function getExpress(){
		$data = getExpressDelivery(input('code'),input('invoice'));
		if($data){
        	echo $this->show(1001,'成功',['data'=>$data['data']]);
        }else{
        	echo $this->show(2001,'失败');
        }
	}
}