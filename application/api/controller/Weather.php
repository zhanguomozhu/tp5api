<?php
namespace app\api\controller;
use app\base\controller\Base;
/**
 * @title 天气接口
 */
class Weather extends Base
{
    /**
     * @title 获取城市天气预报
     * @description 接口说明 根据城市获取当地天气
     * @author 战国墨竹
     * @url /api/weather/get_weather
     * @method GET
     *
     * @param name:city type:string require:0 default:上海 other: desc:城市名称,默认本机IP地址天气
     * 
     * @return error:错误码
     * @return status:状态提示
     * @return date:时间
     * @return results:返回数据@
     * @results currentCity:城市 pm25:pm值 index:指数内容@ weather_data:天气情况@
     * @index title:穿衣 zs:程度 tipt:穿衣指数 des:建议
     * @weather_data date:日期 dayPictureUrl:白天图标 nightPictureUrl:夜晚图标 weather:天气情况 wind:风力 temperature:气温
     * 
     */
    public function get_weather()
    {

        $city=input('city');
        if(empty($city)){
            $city= $this->get_city();
        }
        $res = file_get_contents("http://api.map.baidu.com/telematics/v3/weather?location={$city}&output=json&ak=32da004455c52b48d84a3a484c0dbc99");
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => json_decode($res, true)
        ]);
    }


    /**
     * 根据IP获得城市信息
     * @return [type] [description]
     */
    public function get_city(){
        $getIp = get_client_ip();
        $content = file_get_contents("http://api.map.baidu.com/location/ip?ak=enYCQ2yaIIjL8IZfYdA1gi6hK2eqqI2T&ip=120.237.113.106&coor=bd09ll");
        $json = json_decode($content, true);
        $place =urlencode($json['content']['address_detail']['city']);
        return $place;
    }


}