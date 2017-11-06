<?php
/**
 * 顺丰BSP查单接口
 * Created by PhpStorm.
 * User: Mikkle
 * Email:776329498@qq.com
 * Date: 2017/3/20
 * Time: 14:52
 */

namespace com\sf_express;


class OrderSearchService extends BaseBSP
{
    public function OrderSearch($orderid) {
        $OrderSearch = '<OrderSearch orderid="'.$orderid.'" />';
        $data = $this->postXmlBodyWithVerify($OrderSearch);
        return $this->OrderSearchResponse($data);
    }

    private function OrderSearchResponse($data) {
        return $this->getResponse($data, 'OrderResponse');
    }

}