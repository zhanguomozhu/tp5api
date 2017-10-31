<?php  
namespace app\admin\controller;
use app\base\controller\Base;

/**
* 后台首页控制器
*/
class Index extends Base
{
	/**
	 * 初始化
	 */
	public function __construct(){
		parent::__construct();
		$this->style=['aaa','bbb','vvv'];//定义需要的样式
		$this->js=['jq','angular','vue'];//定义需要的js
	}

	/**
	 * 后台首页
	 * @return [type] [description]
	 */
	public function index()
	{
		return $this->fetch();
	}

	
	public function add()
	{
		return $this->fetch();
	}
}



?>