<?php
namespace app\chat\controller;
use app\base\controller\Base;

class Man extends Base
{

	public function index(){
		return $this->fetch();
	}



}