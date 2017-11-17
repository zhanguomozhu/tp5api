<?php
namespace app\chat\controller;
use app\base\controller\Base;

class Danmu extends Base
{

	public function index(){
		return $this->fetch();
	}



}