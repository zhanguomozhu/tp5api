<?php

// +----------------------------------------------------------------------
// | pay-php-sdk
// +----------------------------------------------------------------------
// | 版权所有 2014~2017 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zoujingli/pay-php-sdk
// +----------------------------------------------------------------------

namespace Pay\Gateways\Wechat;

use Pay\Exceptions\InvalidArgumentException;

/**
 * 微信POS刷卡支付网关
 * Class PosGateway
 * @package Pay\Gateways\Wechat
 */
class PosGateway extends Wechat
{
    /**
     * 接口地址
     * @var string
     */
    protected $gateway = 'https://api.mch.weixin.qq.com/pay/micropay';

    /**
     * 当前操作类型
     * @return string
     */
    protected function getTradeType()
    {
        return 'MICROPAY';
    }

    /**
     * 应用并返回参数
     * @param array $options
     * @return array
     */
    public function apply(array $options = [])
    {
        if (is_null($this->userConfig->get('app_id'))) {
            throw new InvalidArgumentException('Missing Config -- [app_id]');
        }
        unset($this->config['trade_type']);
        unset($this->config['notify_url']);
        return $this->preOrder($options);
    }

}
