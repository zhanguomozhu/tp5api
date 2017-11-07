<?php
namespace app\index\controller;
use think\Controller;

class Appstore extends Controller
{
	// 加载配置参数
	private $appconf;
	// 实例支付对象
	private $pay;

	//初始化
	public function __construct(){
		// 加载配置参数
		$this->appconf = config('pay.app');
	}



	public function index(){

		return view();
	}


	// 支付回调
    public function pay(){
        //苹果内购的验证收据
        $receipt_data = input('get.apple_receipt'); 
        // 验证支付状态
        $result=validate_apple_pay($receipt_data);
        if($result['status']){
            // 验证通过 此处可以是修改数据库订单状态等操作
            $this->success('支付成功');
        }else{
            // 验证不通过
            $this->error('支付失败');
        }
    }

}
