<?php
namespace app\index\controller;
use think\Controller;
include VENDOR_PATH.'thinkpay/paysdk/init.php';//微信支付宝集成sdk支付类
include EXTEND_PATH.'wx/wxRedpack.php';//微信红包支付类
class Wxpay extends Controller
{
	// 加载配置参数
	private $wxconf;
	// 实例支付对象
	private $pay;

	//初始化
	public function __construct(){
		// 加载配置参数
		$this->wxconf = config('pay');
		// 实例支付对象
		$this->pay = new \Pay\Pay($this->wxconf);
	}



	public function index(){

		return view();
	}




	/**
	 * 公众号支付
	 * @return [type] [description]
	 */
    public function mp()
    {
        //include '../init.php';

		// 加载配置参数
		//$config = require(__DIR__ . '/config.php');

		// 支付参数
		$payOrder = [
		    'out_trade_no'     => mt_rand().time(), // 订单号
		    'total_fee'        => 1, // 订单金额，**单位：分**
		    'body'             => '公众号支付测试', // 订单描述
		    'spbill_create_ip' => '', // 支付人的 IP
		    'openid'           => '', // 支付人的 openID
		];

		// 实例支付对象
		//$pay = new \Pay\Pay($this->wxconf);

		try {
		    $options = $this->pay->driver('wechat')->gateway('mp')->apply($payOrder);
		    var_dump($options);
		} catch (Exception $e) {
		    echo "创建订单失败，" . $e->getMessage();
		}

    }


    /**
	 * 扫码支付
	 * @return [type] [description]
	 */
    public function scan()
    {

		// 支付参数
		$payOrder = [
		    'out_trade_no'     => mt_rand().time(), // 订单号
		    'total_fee'        => 1, // 订单金额，**单位：分**
		    'body'             => '扫码支付测试', // 订单描述
		    'spbill_create_ip' => get_client_ip(), // 调用 API 服务器的 IP
		    'product_id'       => time(), // 订单商品 ID
		];

		try {
		    $options = $this->pay->driver('wechat')->gateway('scan')->apply($payOrder);
		    //var_dump($options);
		    echo "<img alt='扫码支付' src='http://paysdk.weixin.qq.com/example/qrcode.php?data=".urlencode($options)."' style='width:300px;height:300px;'/>";
		} catch (Exception $e) {
		    echo "创建订单失败，" . $e->getMessage();
		}

    }


    /**
     * H5 支付
     * @return [type] [description]
     */
    public function wap()
    {
    	// 支付参数
		$payOrder = [
		    'out_trade_no'     => mt_rand().time(), // 订单号
		    'total_fee'        => 1, // 订单金额，**单位：分**
		    'body'             => 'H5 支付测试', // 订单描述
		    'spbill_create_ip' => get_client_ip(), // 支付人的 IP
		];

		try {
		    $options = $this->pay->driver('wechat')->gateway('wap')->apply($payOrder);
		    var_dump($options);
		} catch (Exception $e) {
		    echo "创建订单失败，" . $e->getMessage();
		}
    }



    /**
     * APP 支付
     * @return [type] [description]
     */
    public function app()
    {
    	// 支付参数
		$payOrder = [
		    'out_trade_no'     => mt_rand().time(), // 订单号
		    'total_fee'        => 1, // 订单金额，**单位：分**
		    'body'             => 'APP 支付测试', // 订单描述
		    'spbill_create_ip' => get_client_ip(), // 支付人的 IP
		];

		try {
		    $options = $this->pay->driver('wechat')->gateway('app')->apply($payOrder);
		    var_dump($options);
		} catch (Exception $e) {
		    echo "创建订单失败，" . $e->getMessage();
		}
    }


    /**
     * 刷卡支付
     * @return [type] [description]
     */
    public function pos()
    {
		// 支付参数
		$payOrder = [
		    'out_trade_no'     => mt_rand().time(), // 订单号
		    'total_fee'        => 1, // 订单金额，**单位：分**
		    'body'             => '刷卡支付测试', // 订单描述
		    'spbill_create_ip' => get_client_ip(), // 支付人的 IP
		    'auth_code'        => '', // 授权码
		];

		try {
		    $options = $this->pay->driver('wechat')->gateway('pos')->apply($payOrder);
		    var_dump($options);
		} catch (Exception $e) {
		    echo "创建订单失败，" . $e->getMessage();
		}
    }


    /**
     * 小程序支付
     * @return [type] [description]
     */
    public function miniapp()
    {
		// 支付参数
		$payOrder = [
		    'out_trade_no'     => mt_rand().time(), // 订单号
		    'total_fee'        => 1, // 订单金额，**单位：分**
		    'body'             => '小程序支付测试', // 订单描述
		    'spbill_create_ip' => get_client_ip(), // 支付人的 IP
		    'openid'           => '', // 支付人的 openID
		];

		try {
		    $options = $this->pay->driver('wechat')->gateway('miniapp')->apply($payOrder);
		    var_dump($options);
		} catch (Exception $e) {
		    echo "创建订单失败，" . $e->getMessage();
		}
    }


    /**
     * 企业付款
     * @return [type] [description]
     */
    public function transfer()
    {
		// 支付参数
		$payOrder = [
		    'partner_trade_no' => '', //商户订单号
		    'openid'           => '', //收款人的openid
		    'check_name'       => 'NO_CHECK', //NO_CHECK：不校验真实姓名\FORCE_CHECK：强校验真实姓名
		//    're_user_name'=>'张三', //check_name为 FORCE_CHECK 校验实名的时候必须提交
		    'amount'           => 100, //企业付款金额，单位为分
		    'desc'             => '帐户提现', //付款说明
		    'spbill_create_ip' => '192.168.0.1', //发起交易的IP地址
		];

		try {
		    $options = $this->pay->driver('wechat')->gateway('transfer')->apply($payOrder);
		    var_dump($options);
		} catch (Exception $e) {
		    echo "创建订单失败，" . $e->getMessage();
		}
    }



    /**
     * 异步回调
     * @return [type] [description]
     */
    public function notify()
    {

		$verify = $this->pay->driver('wechat')->gateway('mp')->verify(file_get_contents('php://input'));
		if ($verify) {
		    file_put_contents('notify.txt', "收到来自微信的异步通知\r\n", FILE_APPEND);
		    file_put_contents('notify.txt', '订单号：' . $verify['out_trade_no'] . "\r\n", FILE_APPEND);
		    file_put_contents('notify.txt', '订单金额：' . $verify['total_fee'] . "\r\n\r\n", FILE_APPEND);
		} else {
		    file_put_contents('notify.txt', "收到异步通知\r\n", FILE_APPEND);
		}
		echo "success";
    }



    /**
     * 公众号发红包
     * @return [type] [description]
     */
    public function sendredpack()
    {
  		//配置好自己的参数,注意这里的两个证书路径得根据你自己的项目证书路径来写,同时存放证书的目录要开放可读权限
		$config = array(
			'wxappid'		=> 'wx426b3015555a46be',
			'mch_id'	 	=> '1900009851',
			'pay_apikey' 	=> '8934e7d15453e97507ef794cf7b0519d',
			'api_cert'		=> EXTEND_PATH.'wx/cert/apiclient_cert.pem',// 微信证书 cert 文件
			'api_key'		=> EXTEND_PATH.'wx/cert/apiclient_key.pem',// 微信证书 key 文件
		);
		$openid 	= '';	//openid
		$money 		= '';	//金额
		$trade_no 	= '';	//订单号
		$act_name 	= '';	//活动名称 

		$redpack = new \WxRedpack($config);								//初始化类(同时传递参数)
		dump($redpack);
		$res = $redpack->sendredpack($openid,$money,$trade_no,$act_name);		//发红包
    	dump($res);
    }


    /**
     * 企业付款
     * @return [type] [description]
     */
    public function mchpay()
    {
  		//配置好自己的参数,注意这里的两个证书路径得根据你自己的项目证书路径来写,同时存放证书的目录要开放可读权限
		$config = array(
			'wxappid'		=> 'wx426b3015555a46be',
			'mch_id'	 	=> '1900009851',
			'pay_apikey' 	=> '8934e7d15453e97507ef794cf7b0519d',
			'api_cert'		=> EXTEND_PATH.'wx/cert/apiclient_cert.pem',// 微信证书 cert 文件
			'api_key'		=> EXTEND_PATH.'wx/cert/apiclient_key.pem',// 微信证书 key 文件
		);
		$openid 	= '';	//openid
		$money 		= '';	//金额
		$trade_no 	= '';	//订单号
		$act_name 	= '';	//活动名称 

		$redpack = new \WxRedpack($config);								//初始化类(同时传递参数)
		$res = $redpack->mchpay($openid,$money,$trade_no,$act_name);			//企业付款
    	dump($res);
    }




}
