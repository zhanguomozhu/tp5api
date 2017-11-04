<?php
namespace app\index\controller;
use think\Controller;
include VENDOR_PATH.'thinkpay/paysdk/init.php';
class Alipay extends Controller
{
	// 加载配置参数
	private $aliconf;
	// 实例支付对象
	private $pay;

	//初始化
	public function __construct(){
		// 加载配置参数
		$this->aliconf = config('pay');
		// 实例支付对象
		$this->pay = new \Pay\Pay($this->aliconf);
	}


	public function index(){
		return view();
	}

	/**
	 * 电脑支付
	 * @return [type] [description]
	 */
    public function web()
    {
        //include '../init.php';

		// 加载配置参数
		//$config = require(__DIR__ . '/config.php');

		// 支付参数
		$payOrder = [
		    'out_trade_no' => '', // 商户订单号
		    'total_amount' => '1', // 支付金额
		    'subject'      => 'test subject', // 支付订单描述
		];

		try {
		    $options = $this->pay->driver('alipay')->gateway('web')->apply($payOrder);
		    var_dump($options);
		} catch (Exception $e) {
		    echo "创建订单失败，" . $e->getMessage();
		}

    }




    /**
	 * 手机网站支付
	 * @return [type] [description]
	 */
    public function wap()
    {
		// 支付参数
		$payOrder = [
		    'out_trade_no' => '', // 商户订单号
		    'total_amount' => '1', // 支付金额
		    'subject'      => 'test subject', // 支付订单描述
		];

		try {
		    $options = $this->pay->driver('alipay')->gateway('wap')->apply($payOrder);
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
		    'out_trade_no' => '', // 商户订单号
		    'total_amount' => '1', // 支付金额
		    'subject'      => 'test subject', // 支付订单描述
		];

		try {
		    $options = $this->pay->driver('alipay')->gateway('scan')->apply($payOrder);
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
		    'out_trade_no' => '', // 商户订单号
		    'total_amount' => '1', // 支付金额
		    'subject'      => 'test subject', // 支付订单描述
		];

		try {
		    $options = $this->pay->driver('alipay')->gateway('app')->apply($payOrder);
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
		    'out_trade_no' => '', // 商户订单号
		    'total_amount' => '1', // 支付金额
		    'subject'      => 'test subject', // 支付订单描述
		];

		try {
		    $options = $this->pay->driver('alipay')->gateway('pos')->apply($payOrder);
		    var_dump($options);
		} catch (Exception $e) {
		    echo "创建订单失败，" . $e->getMessage();
		}
    }


    /**
     * 帐户转账（可用于平台用户提现）
     * @return [type] [description]
     */
    public function transfer()
    {
		// 支付宝转账参数
		$payOrder = [
		    'out_biz_no'      => '', // 订单号
		    'payee_type'      => 'ALIPAY_LOGONID', // 收款方账户类型(ALIPAY_LOGONID | ALIPAY_USERID)
		    'payee_account'   => 'demo@sandbox.com', // 收款方账户
		    'amount'          => '10', // 转账金额
		    'payer_show_name' => '未寒', // 付款方姓名
		    'payee_real_name' => '张三', // 收款方真实姓名
		    'remark'          => '张三', // 转账备注
		];

		try {
		    $options = $this->pay->driver('alipay')->gateway('transfer')->apply($payOrder);
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
		if ($this->pay->driver('alipay')->gateway()->verify($_POST)) {
		    file_put_contents('notify.txt', "收到来自支付宝的异步通知\r\n", FILE_APPEND);
		    file_put_contents('notify.txt', '订单号：' . $_POST['out_trade_no'] . "\r\n", FILE_APPEND);
		    file_put_contents('notify.txt', '订单金额：' . $_POST['total_amount'] . "\r\n\r\n", FILE_APPEND);
		} else {
		    file_put_contents('notify.txt', "收到异步通知\r\n", FILE_APPEND);
		}

		echo "success";
    }
}
