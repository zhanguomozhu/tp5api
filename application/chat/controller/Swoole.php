<?php
namespace app\chat\controller;
use app\base\controller\Base;

class Swoole extends Base
{

	public function index(){
		return $this->fetch();
	}


}