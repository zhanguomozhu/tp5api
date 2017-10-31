<?php 
namespace app\admin\controller;
use think\Controller;
use think\Auth;
use think\Request;
class Common extends Controller
{
	public function _initialize()
    {
       if(!session('uid') || !session('username')){
       	$this->error('您尚未登录','Login/login');
       }

       $auth = new Auth();
       $request = Request::instance();
       $controller = $request->controller();
       $method = $request->action();
       $name = $controller.'/'.$method;
       $not_check = array("Index/index","Admin/logout");
       if(session('uid') != 1){
       		if(!in_array($name,$not_check)){
       				if(!$auth->check($name,session('uid'))){
			       		$this->error('没有权限','Index/index');
			        }
       		}
       }
       

    }

}