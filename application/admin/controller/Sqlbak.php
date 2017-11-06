<?php 
namespace app\admin\controller;
use app\base\controller\Base;

class Sqlbak extends Base
{

	//数据库备份
	public function index(){
		$type=input("tp");//操作
		$name=input("name");//文件名
		$sql=new \org\Baksql(\think\Config::get("database"));

		switch ($type)
		{
			case "backup": //备份
				return $sql->backup();
			break;
			case "dowonload": //下载
				$sql->downloadFile($name);
			break;
			case "restore": //还原
				return $sql->restore($name);
			break;
			case "del": //删除
				return $sql->delfilename($name);
			break;
			default: //获取备份文件列表
				return $this->fetch("index",["list"=>$sql->get_filelist()]);
		 
		}
	}

}