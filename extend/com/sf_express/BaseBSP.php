<?php
/**
 * 顺丰BSP基础代码
 * Created by PhpStorm.
 * User: Mikkle
 * Email:776329498@qq.com
 * Date: 2017/2/14
 * Time: 16:49
 */
namespace com\sf_express;

class BaseBSP extends BaseSupport
{

    protected $config = [
        'accesscode' => 'BSPdevelop' ,                 //商户号码
        'checkword' => 'j8DzkIFgmlomPt0aLuwU',         //商户密匙
        'server' => "http://bsp-ois.sit.sf-express.com:9080/",
        'server_ssl' => "https://bsp-ois.sit.sf-express.com:9443",
        'ssl' => false,
        'uri' => 'bsp-ois/sfexpressService',
    ];

    protected $ret = array(
        'head' => "ERR",
        'message' => '系统错误',
        'code' => -1
    );

    public function __construct($params = null)
    {
        if (null != $params) {
            $this->config = array_merge($this->config, $params);
        }
    }

    /**
     * 顺丰BSP接口主程序 已经已经集成验证
     * User: Mikkle
     * Q Q:776329498
     * @param $xml
     * @return bool|mixed
     */
    public function postXmlBodyWithVerify($xml){
        $xml=$this->buildXml($xml);
        $verifyCode=$this->sign($xml, $this->config['checkword']);
        $post_data="xml=$xml&verifyCode=$verifyCode";
        $response=$this->postXmlCurl($post_data,$this->getPostUrl());
        return $response;
    }


    /**
     * get request service name
     * User: Mikkle
     * Q Q:776329498
     * @param null $class
     * @return string
     */
    public function getServiceName($class=null) {
        if (empty($class)) {
            return basename(str_replace('\\', '/', get_called_class()),'.php');
        }
        return basename(str_replace('\\', '/', $class),'.php');;
    }

    /**
     * 拼接XML字符串
     * User: Mikkle
     * Q Q:776329498
     * @param $bodyData
     * @return string
     */
    public function buildXml($bodyData){
        $xml = '<Request service="'.$this->getServiceName().'" lang="zh-CN">' .
            '<Head>'.$this->config['accesscode'].'</Head>' .
            '<Body>' . $bodyData . '</Body>' .
            '</Request>';
        return $xml;
    }


    /**
     * 获取POST地址
     * User: Mikkle
     * Q Q:776329498
     * @return string
     */
    protected function getPostUrl(){
        if($this->config['ssl']){
            return   $this->config['server_ssl'].$this->config['uri'];
        } else {
            return   $this->config['server'].$this->config['uri'];
        }
    }


}