<?php
namespace app\chat\controller;
use app\base\controller\Base;

class Ajax extends Base
{


	public function index(){
		return $this->fetch();
	}


	public function sendmsg(){
		if(request()->isAjax()){
			
			//数据库字段 网页字段转换，过滤参数
            $param = [
            	'send'=>'admin',
            	'msg' 	=>'msg',
                'receive' =>'receive',
            ];
            $param_data = $this->buildParam($param);
			$res = model('Liaotian')->addMsg($param_data);
			if($res){
				echo $this->show(1001,"发表留言成功！");
			}else{
				echo $this->show(2001,"发表留言失败！");
			}
		}
	}

	public function getmsg(){
		if(request()->isAjax()){
			$id = input('maxID');
			$where = [
				'id'=>['gt',$id],
			];
			
			$res = model('Liaotian')->where($where)->select();
			if($res){
				echo $this->show(1001,"成功！",$res);
			}else{
				echo $this->show(2001,"失败！");
			}
		
		}
	}
}