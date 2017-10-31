<?php
namespace app\base\controller;
use think\Controller;
use think\Validate;
class SendSms extends Controller
{
	public static $sms_config = [
		'appkey'		=> '2358*****',//阿里大于APPKEY
		'secretKey' 	=> '60ec4baf8dfb46*******************',//阿里大于secretKey
		'FreeSignName' 	=> '短信签名',//短信签名
	];
	public function sms($data=[])
	{
		$validate = new Validate([
			['param','require|array','参数必填|参数必须为数组'],
			['mobile','require|/1[34578]{1}\d{9}$/','手机号错误|手机号错误'],
			['template','require','模板id错误'],
		]);
		if (!$validate->check($data)) {
			return $validate->getError();
		}
		define('TOP_SDK_WORK_DIR', CACHE_PATH.'sms_tmp/');
		define('TOP_SDK_DEV_MODE', false);
		vendor('alidayu.TopClient');
		vendor('alidayu.AlibabaAliqinFcSmsNumSendRequest');
		vendor('alidayu.RequestCheckUtil');
		vendor('alidayu.ResultSet');
		vendor('alidayu.TopLogger');
		$config = self::$sms_config;
		$c = new \TopClient;
		$c->appkey = $config['appkey'];
		$c->secretKey = $config['secretKey'];
		$req = new \AlibabaAliqinFcSmsNumSendRequest;
		$req->setExtend('');
		$req->setSmsType('normal');
		$req->setSmsFreeSignName($config['FreeSignName']);
		$req->setSmsParam(json_encode($data['param']));
		$req->setRecNum($data['mobile']);
		$req->setSmsTemplateCode($data['template']);
		$result = $c->execute($req);
		$result = $this->_simplexml_to_array($result);
		if(isset($result['code'])){
			return $result['sub_code'];
		}
		return true;
	}

	private function _simplexml_to_array($obj)
	{
		if(count($obj) >= 1){
			$result = $keys = [];
			foreach($obj as $key=>$value){
				isset($keys[$key]) ? ($keys[$key] += 1) : ($keys[$key] = 1);
				if( $keys[$key] == 1 ){
					$result[$key] = $this->_simplexml_to_array($value);
				}elseif( $keys[$key] == 2 ){
					$result[$key] = [$result[$key], $this->_simplexml_to_array($value)];
				}else if( $keys[$key] > 2 ){
					$result[$key][] = $this->_simplexml_to_array($value);
				}
			}
			return $result;
		}else if(count($obj) == 0){
			return (string)$obj;
		}
	}


/**
     * 发送手机短信验证码
     * #User: Mikkle
     * #Email:776329498@qq.com
     * #Date:
     * @param bool|false $mobile
     * @return 出错返回1003错误码和错误详情|返回错误码
     */
    public function sendRegSms($mobile=false){
        if (!$this->request->isAjax() ) return $this->showCode(1002);

        if(!$mobile) $mobile=$this->request->param('mobile');
        if (!$mobile) return $this->showCode(1004);
        if (model('base/User')->infoByMobile($mobile)) return $this->showCode(1003,'该手机已经注册过,请勿重新注册');
        $data_mobile['mobile']=$mobile;
        $result_mobile=$this->checkValidate($data_mobile,'base/Register.mobile',true);
        if ( isset($result_mobile['code']) ) return  $result_mobile;
        if(!$this->checkRegSms($mobile)) return $this->showCode(1003,'请勿一分钟内重复申请验证码');

        $req=$this->sendSmsCode($mobile);
        if ($req===true){
            return $this->showCode(1001);
        }else{
            return $this->showCode(1003,$req);
        }
    }


    protected function sendSmsCode($mobile = false)
    {
        if (!$mobile) return false;
        $code = rand(10000, 99999);
        $data = [
            'param' => ['code' => (string)$code, 'product' => '【****】'],
            'mobile' => $mobile,
            'template' => 'SMS_37185084',
        ];
        $req = controller('base/SendSms')->sms($data);
        if ($req === true) {
            $data_cache = [
                'mobile' => $mobile,
                'code' => (string)$code,
                'times' => time() + 60,
            ];
            $this->setRegSmsCache($data_cache);
            return true;
        } else {
            return $req;
        }

    }

     /**
     * 设置手机短息验证码缓存
     * #User: Mikkle
     * #Email:776329498@qq.com
     * #Date:
     * @param $data_cache
     */
    protected function setRegSmsCache($data_cache)
    {
        Cache::set('sms_' . $data_cache['mobile'], $data_cache, 300);
    }


     /**
     * 检测手机短信验证码
     * #User: Mikkle
     * #Email:776329498@qq.com
     * #Date:
     * @param $mobile
     * @param bool|false $code
     * @return bool
     */
    protected function checkRegSms($mobile, $code = false)
    {
        if (!$mobile) return false;
        if ($code === false) {   //判断60秒以内是否重复发送
            if (!Cache::has('sms_' . $mobile)) return true;
            if (Cache::get('sms_' . $mobile)['times'] > time()) {
                return false;
            } else {
                return true;
            }
        } else {  //判断验证码是否输入正确
            if (!Cache::has('sms_' . $mobile)) return false;
            if (Cache::get('sms_' . $mobile)['code'] == $code) {
                return true;
            } else {
                return false;
            }
        }
    }


}
