<?php 
namespace app\admin\controller;
use app\base\controller\Base;
use think\Loader;
use phpmail\Email;//邮件发送类
class Login extends Base
{
	private $captcha;//验证码对象
	public $email;//验证码对象
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

		//加载邮件类
        //使用案例 $this->email->send('976352324@qq.com',$title,$content);
        $this->email = new Email;
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
    		//模拟发送邮件信息
    		$param_data['token']=md5($param_data['username'].$param_data['password'].time());//创建邮件激活码
			$param_data['token_exptime']=time()+60*60*24;//过期时间为24小时后	
			$param_data['lock'] = 1;//锁定账号，激活后设置为0
            //插入数据库
			$res = model('admin')->register($param_data);
			if($res){
				//dump($res);die;
				//用户注册成功后添加用户角色表,默认是普通会员
				$role['uid']=$res;
				$role['group_id']=13;
				model('AuthGroupAccess')->save($role);


				//信息添加完毕后，发送激活邮件******************************
				$email='976352324@qq.com';//注册邮箱
				$title="用户账号激活";//邮件标题
				//邮件主题
				$content="亲爱的".$param_data['username']."：<br/>感谢您在我站注册了新帐号。<br/>请点击链接激活您的帐号。<br/> 
	    				<a href='".request()->domain().url('admin/login/check',array('verify'=>$param_data['token']))."' target= 
						'_blank'>".request()->domain().url('admin/login/check',array('verify'=>$param_data['token']))."</a><br/> 
	    				如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。";
	        	//发送邮件
	        	$eee = $this->email->send($email,$title,$content);
				$this->success('注册成功','admin/login/login');
			}else{
				$this->error('注册失败,请重试');
			};
			return;
		}
		return $this->fetch();
	}




	//激活账号邮箱操作
	public function check()
	{
		$data['token']= trim(input('verify'));
		$data['lock'] = 1;
		$res=model('Admin')->field('id,token_exptime')->where($data)->find();
		if($res)
		{
			if(time()>$res['token_exptime'])
			{
				$this->error("激活时间已过期!请重新登录发送激活邮件！",url('admin/login/login'));
			}
			else
			{
				$data['lock'] = 0;
				$row=model('Admin')->save($data,["id"=>$res['id']]);
				if($row){
					$this->success("激活成功!请登录",url('admin/login/login'));
				}else{
					$this->error("激活失败！请联系管理员！",url('admin/login/login'));
				}
				
			}
		}else{
			$this->error("获取数据失败！请联系管理员！",url('admin/Login/login'));
		}
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



	/**滑动验证
     * geetest生成验证码
     */
    public function geetest_show_verify(){
        $geetest_id=config('geetest.geetest_id');
        $geetest_key=config('geetest.geetest_key');
        $geetest=new \org\Geetest($geetest_id,$geetest_key);
        $user_id = "test";
        $status = $geetest->pre_process($user_id);
        session('geetest',['gtserver'=>$status,'user_id'=>$user_id],'tp5');
        echo $geetest->get_response_str();
    }



    /**
     * geetest submit 提交验证
     */
    public function geetest_submit_check(){
        $data=input('post.');
        if (geetest_chcek_verify($data)) {
            echo '验证成功';
        }else{
            echo '验证失败';
        }
    }

    /**
     * geetest ajax 验证
     */
    public function geetest_ajax_check(){
        $data=input('post.');
        echo intval(geetest_chcek_verify($data));
    }

}