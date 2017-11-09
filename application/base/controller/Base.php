<?php  
namespace app\base\controller;
use think\Controller;
use think\Auth;
use think\Request;
use org\Map;//百度地图类
use phpmail\Email;//邮件发送类
use org\Pinyin;//汉字转拼音类
use org\Ucpaas;//云之讯短信类
use \Endroid\QrCode;//二维码类
/**
* 基类控制器
*/
class Base extends Controller
{

	public $style=[];	//需要加载的css样式
    public $js=[];      //需要加载的js
    public $map;      //地图类
    public $email;      //邮件类
    public $ucpaas;     //云之讯短信类
    public $alidayu;        //阿里大鱼短信类
    public $qrcode;     //二维码类
    public $pinyin;     //拼音类

    /**
     * 初始化公共数据
     * @return [type] [description]
     */
    public function _initialize()
    {   
        //登录检测
        $this->checkLogin();

        //检测是否有异地登录
        $this->checkSessionId();

        //检查权限
        $this->checkAuth();

        //左侧菜单显示
        $this->leftMenu();

        //加载地图类
        //使用案例  $this->map->staticimage('上海呼兰路地铁站');
        $this->map = new Map;

        //加载邮件类
        //使用案例 $this->email->send('976352324@qq.com',$title,$content);
        $this->email = new Email;
        
        //加载云之讯短信类
        //使用案例 $this->sms->send(15617578175);
        //初始化必填
        $options['accountsid']=config('ysms.accountsid'); //填写自己的accountsid
        $options['token']=config('ysms.token'); ; //填写自己的token
        $this->ucpaas = new Ucpaas($options);
        
        //加载阿里大鱼短信类
        include EXTEND_PATH.'alidayu/TopSdk.php';//这是载入阿里大鱼
        $this->alidayu = new \TopClient();


        //加载拼音类
        //使用案例 
        //$this->pinyin::encode('阿里巴巴科技有限公司'); //编码为拼音首字母
        //$this->pinyin::encode('阿里巴巴科技有限公司', 'all'); //编码为全拼音
        $this->pinyin = new Pinyin();
    }


    /**
     * 检测是否登录
     * @return [type] [description]
     */
    private function  checkLogin(){
        //检测session 是否有用户信息
        if(!session(session_id().'_uid','','global') && !session(session_id().'_username','','global')){
            $this->error('您尚未登录','login/login');
        }else{
            //账户信息
            $admin = model('admin')->where(['id'=>session(session_id().'_uid','','global'),'username'=>session(session_id().'_username','','global')])->column('username');
            if($admin){
                $this->assign('user',$admin[0]);//登录用户名
            }else{
                $this->error('登录失败','admin/login/login');
            }
        }
    }



    /**
     * 检测权限
     * @return [type] [description]
     */
    private  function  checkAuth(){
       
        $auth       = new Auth();
        $request    = Request::instance();                  //初始化request
        $controller = $request->controller();               //控制器
        $method     = $request->action();                   //方法
        $name       = $controller.'/'.$method;              //拼接权限名称
        $not_check  = array(                                //禁止检测权限
                        "Index/index",              //后台首页
                        "Admin/loginout",           //后台登出
                        'Admin/changePW'            //修改密码
                        );
        if(session(session_id().'_uid') != 1){              //检测是用户是否登录
             //检测是否超级管理员
             $admin = model('Admin')->field('admin')->find(session(session_id().'_uid','','global'));
            if($admin['admin'] != 0){
                if(!in_array($name,$not_check)){                //过滤权限检测
                    if(!$auth->check($name,session(session_id().'_uid','','global'))){//检测权限
                        $this->error('没有权限','Index/index');
                    }
                }
            }
        }
    }


    /**
     * 左侧菜单栏显示
     * @return [type] [description]
     */
    private  function leftMenu(){
        //菜单数据
        $menus = model('AuthRule')->getTree(['status'=>1],2);
        //dump($menus);
        //查看用户角色权限
        $rule_access = model('AuthGroupAccess')->getAuths(session(session_id().'_uid','','global'));
        //dump($rules);

        $this->assign(['leftMenus'=>$menus,'rule_access'=>$rule_access]);
     
    }


    /**
     * 检测是否有异地登录
     * @return [type] [description]
     */
    public function checkSessionId(){
        //查询数据表
        $user = model('Admin')->where(['id'=>session(session_id().'_uid','','global')])->find();  
        //本地session
        $session_id = session_id();
        //判断是否异地
        if($user['session_id'] != $session_id){  
            session_destroy();  
            $this->error('您的账号在其他地方登录,您已经被强制下线', url('admin/login/login'));  
        }  
    }


    /**
     *  获取用户信息
     */
    public function getUserInfo(){
        $res = model('Admin')->where(['id'=>session(session_id().'_uid','','global')])->find();
        return $res;
    }




	 /**
     * 获取当前类名称
     * Power: Mikkle
     * Email：776329498@qq.com
     * @param bool|false $all
     * @return string
     */
    public function getClassName($all = false){
        return $all ? get_called_class() : basename(str_replace('\\', '/', get_called_class()),'.php');
    }

	/**
	 * api返回数据
	 * @param  [type] $code    [状态]
	 * @param  [type] $msg     [提示]
	 * @param  array  $data    [数据]
	 * @return [type]          [json]
	 */
	static public function show($code,$msg='',$data=[])
	{
		$return_data = [
            'code' => '500',
            'msg' => '未定义消息',
            'data' => $code == 1001 ? $data : [],
        ];
        if (empty($code)) return $return_data;
        $return_data['code'] = $code;
        if(!empty($msg)){
            $return_data['msg'] = $msg;
        }else if (isset(ReturnCode::$return_code[$code]) ) {
            $return_data['msg'] = ReturnCode::$return_code[$code];
        }
        return json_encode($return_data);
	}


	/**
     * 数据库字段 网页字段转换
     * 标识为数据库字段 值为浏览器提交字段
     * @param $array   标识为数据库字段 值为浏览器提交字段
     * @param bool|false $uuid  是否追加UUID信息
     * @return array
     */
    protected function buildParam($array,$uuid=false)
    {
        $data=[];
        foreach( $array as $item=>$value ){
            $data[$item] = $this->request->param($value);
        }
        if ($uuid && isset($this->uuid)){
            $data['uuid'] = $this->uuid;
        }
        return $data;
    }
    

    /**
     * 上传图片
     * @return [type] [description]
     */
    public function douploadimg(){
        if(request()->isAjax()){
            // 获取表单上传文件 例如上传了001.jpg
            $file = request()->file('img');
            //执行上传操作
            $info = $file->validate(config("uploadfile.upload_images_validate"))->move(ROOT_PATH . 'public' . DS .config('uploadfile.upload_images_path'));

            if($info){
                //获取文件名
                $path = config('uploadfile.upload_images_path').'/'.$info->getSaveName();
                //图片处理
                $img =Image::open($path);
                //获取图像信息
                // 返回图片的宽度
                $width = $img->width(); 
                // 返回图片的高度
                $height = $img->height(); 
                // 返回图片的类型
                $type = $img->type(); 
                // 返回图片的mime类型
                $mime = $img->mime(); 
                // 返回图片的尺寸数组 0 图片宽度 1 图片高度
                $size = $img->size(); 
                //文字水印字体
                $fonts = './static/qrcode/fonts/STXINGKA.TTF';
                //图片水印logo路径
                $logo = './static/admin/images/adam-jansen.jpg';
                //保存路径
                $save_crop  = config('uploadfile.upload_images_path').'/crop/'.date("YmdHis").'.png';//剪裁
                $save_thumb = config('uploadfile.upload_images_path').'/thumb/'.date("YmdHis").'.png';//压缩
                $save_rotate= config('uploadfile.upload_images_path').'/rotate/'.date("YmdHis").'.png';//图片旋转
                $save_water = config('uploadfile.upload_images_path').'/water/'.date("YmdHis").'.png';//图片水印
                $save_text  = config('uploadfile.upload_images_path').'/text/'.date("YmdHis").'.png';//文字水印
                //剪裁
                $img->crop(300, 300)->save($save_crop);
                //缩略图
                $img->thumb(150, 150)->save($save_thumb);
                //图片旋转
                $img->rotate()->save($save_rotate);
                //图片水印
                $img->water($logo)->save($save_water); 
                //文字水印
                $img->text('十年磨一剑',$fonts,20,'#ffffff')->save($save_text);
                //删除处理后的图片
                unlink($save_crop);
                unlink($save_thumb);
                unlink($save_rotate);
                unlink($save_water);
                unlink($save_text);
                if($path){
                    echo $this->show(1001,'上传成功',['data'=>$path]);
                }else{
                    echo $this->show(2001,$file->getError());
                }
            }else{
                echo $this->show(2001,$file->getError());
            }

            

        }
    }



    /**
     * 上传图片,返回json
     * @return [type] [description]
     */
    public function douploadfile(){
        if(request()->isAjax()){
            // 获取表单上传文件 例如上传了001.jpg
            $file = request()->file('file');
            //执行上传操作
            $info = $file->validate(config("uploadfile.upload_files_validate"))->move(ROOT_PATH . 'public' . DS .config('uploadfile.upload_files_path'));
           
            if($info){
                //获取文件名
                $path = config('uploadfile.upload_files_path').'/'.$info->getSaveName();
                if($path){
                    echo $this->show(1001,'上传成功',['data'=>$path]);
                }else{
                    echo $this->show(2001,$file->getError());
                }
            }else{
                echo $this->show(2001,$file->getError());
            }

        }
    }



    /**
     * 上传excel
     * @return [type] [description]
     */
    public function doUploadExcel(){
        if(request()->isAjax()){
            // 获取表单上传文件 例如上传了001.jpg
            $file = request()->file('file');
            //执行上传操作
            $info = $file->validate(config("uploadfile.upload_files_validate"))->move(ROOT_PATH . 'public' . DS .config('uploadfile.upload_files_path'));
            if($info){
                 //获取文件名
                $path = config('uploadfile.upload_files_path').'/'.$info->getSaveName();
                if($path){
                    return $path;
                }else{
                    return false;
                }
            }else{
               return false;
            }

        }
    }


    /**
     * 删除上传文件
     * @return [type] [description]
     */
    public function delfile(){
        if(request()->isAjax()){
            //搜索替换路径中\
            $url = trim(input('src'),'/');
                $res = unlinks($url);
                if($res){
                    echo $this->show(1001,'删除成功');
                }else{
                    echo $this->show(2001,'删除失败');
                }
        }
    }

}

