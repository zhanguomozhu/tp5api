<?php 
namespace org;
/**
 * 百度地图相关业务封装
 */

class Map
{

/**
 * 根据地址来获取经纬度
 * @param  [type] $address [str]
 * @return [type]          [array]
 */
public static function getLngLat($address)
{
	//http://api.map.baidu.com/geocoder/v2/?address=北京市海淀区上地十街10号&output=json&ak=E4805d16520de693a3fe707cdc962045&callback=showLocation
	if(!$address){
		return '';
	}
	$data = [
		'address' => $address,
		'ak'	=>config('map.ak'),
		'output'=>'json',
	];
	//转换成url格式
	$url = config('map.baidu_map_url').config('map.geocoder').'?'.http_build_query($data);
	//请求接口
	$result = doCurl($url);
	if($result){
		return json_decode($result,true);
	}else{
		return [];
	}
	//return $result;
}


/**
 * 根据经纬度或者地址来获取百度地图
 * @param  [type] $center [description]
 * @return [type]         [description]
 */
public static function staticimage($center)
{
	//http://api.map.baidu.com/staticimage/v2
	if(!$center){
		return '';
	}
	$data = [
		'ak' 		=> 	config('map.ak'),
		'width'		=>	config('map.width'),
		'height'	=>	config('map.height'),
		'center'	=>	$center,
		'markers'	=>	$center,
	];
	//转换成url格式
	$url = config('map.baidu_map_url').config('map.staticimage').'?'.http_build_query($data);
	//请求接口
	$result = doCurl($url);
	return $result;
}




}