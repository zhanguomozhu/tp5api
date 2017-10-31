<?php 
namespace app\admin\controller;
use app\base\controller\Base;
use think\Loader;
class Login extends Base
{
	private $captcha;//验证码对象
	public function _initialize(){
		$config =    [
		    // 验证码字体大小
		    'fontSize'    =>    40,  
		    //开启中文验证码
		    'useZh'			=> false,  
		    // 验证码位数
		    'length'      =>    4,   
		    // 关闭验证码杂点
		    'useNoise'    =>    true, 
		];
		$this->captcha = new \think\captcha\Captcha($config);
	}

	/**
	 * 登录
	 * @return [type] [description]
	 */
	public function login()
	{
		if(request()->isPost()){
			if(!$this->check_verify(input('code'))){
				$this->error('验证码错误');
			}
			$res = model('admin')->login(input('post.'));
			if($res == 1){
				$this->error('用户不存在','register');
			};
			if($res == 2){
				$this->success('登陆成功','Index/index');
			};
			if($res == 3){
				$this->error('用户名或者密码错误');
			};
			return;
		}
		return $this->fetch();
	}



	/**
	 * 注册
	 * @return [type] [description]
	 */
	public function register()
	{
		if(request()->isPost()){
			//数据库字段 网页字段转换，过滤参数
            $param = [
                'username' => 'username',
                'password' => 'password',
                'password1' => 'password1',
                'phone' => 'phone',
            ];
            $param_data = $this->buildParam($param);

            //实例化验证器
    		$validate = Loader::validate('Admin');
    		//验证
    		if (!$validate->scene('register')->check($param_data)) {
    			return $this->error($validate->getError());
    		}
            //插入数据库
			$res = model('admin')->register($param_data);
			if($res){
				$this->success('注册成功','admin/index/index');
			}else{
				$this->error('注册失败,请重试');
			};
			return;
		}
		return $this->fetch();
	}

	/**
	 * 生成验证码
	 * @return [type] [description]
	 */
	public function verify()
	{
		return $this->captcha->entry();	
	}

	/**
	 * 检测验证码
	 * @param  [type] $code [description]
	 * @param  string $id   [description]
	 * @return [type]       [description]
	 */
	function check_verify($code, $id = ''){
	    return $this->captcha->check($code, $id);
	}

	/**
	 * 注册ajax验证
	 * @return [type] [description]
	 */
	public function yanzheng(){
	  	if(request()->isAjax())
	  	{
		  	$username	=	input('username')?input('username'):'';//验证用户名
			//$password	=	input('password');
			$phone		=	input('phone')?input('phone'):'';//验证手机号
			//$code       =	input('code');
			if(isset($username) && !empty($username))
			{
	    		if(model('admin')->where(['username'=>$username])->find()){
		        	echo $this->show(1031);
			  	}else{
			   		echo $this->show(1032);
			  	}
			}elseif(isset($phone) && !empty($phone))
			{
	    		if(model('admin')->where(['phone'=>$phone])->find()){
		        	echo $this->show(1033);
			  	}else{
			   		echo $this->show(1034);
			  	}
			}
		}
	}



}