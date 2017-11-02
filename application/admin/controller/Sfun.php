<?php 
namespace app\admin\controller;
use app\base\controller\Base;
use think\Image;
use think\image\Exception as ImageException;
class Sfun extends Base
{

	public function index(){
		return $this->fetch();
	}
	/**
	 * 上传图片
	 * @return [type] [description]
	 */
	public function uploadfile(){
		return $this->fetch();
	}

	

	/**
	 * 异位或加密字符串
	 * @return [type] [description]
	 */
	public function encstr(){
		if(request()->isAjax()){
			$type = input('type');
			if($type){//解密
				$res = enctypetion(input('str'),1);
			}else{//加密
				$res = enctypetion(input('str'),0);
			}
			if($res){
				echo $this->show(1001,'成功',['data'=>$res]);
			}else{
				echo $this->show(2001);
			}
		}
	}

	/**
	 * 加密解密url
	 * @return [type] [description]
	 */
	public function encurl(){
		if(request()->isAjax()){
			$type = input('type');
			if($type){//解密
				$res = path_decode(input('hurl'));
			}else{//加密
				$res = path_encode(input('hurl'));
			}
			if($res){
				echo $this->show(1001,'成功',['data'=>$res]);
			}else{
				echo $this->show(2001);
			}
		}
	}
	/**
	 * 星座转换
	 * @return [type] [description]
	 */
	public function sign(){
		if(request()->isAjax()){
			$month = date('m',strtotime(input('sign')));
			$day = date('d',strtotime(input('sign')));
			$res = get_zodiac_sign($month,$day);
			if($res){
				echo $this->show(1001,'成功',['data'=>$res]);
			}else{
				echo $this->show(2001);
			}
		}
	}
	/**
	 * 获取ip地址
	 * @return [type] [description]
	 */
	public function ipAdress(){
		if(request()->isAjax()){
			$res = get_client_ip();
			if($res){
				echo $this->show(1001,'成功',['data'=>$res]);
			}else{
				echo $this->show(2001);
			}
		}
	}
	/**
	 * 不区分大小写in_array()	
	 * @return [type] [description]
	 */
	public function inArr(){
		if(request()->isAjax()){
			$arr1 = input('inArr1');
			$arr2 = explode(',',input('inArr2'));
			$res = in_iarray($arr1,$arr2);
			if($res){
				echo $this->show(1001,'成功',['data'=>$arr1.'在'.input('inArr2').'里']);
			}else{
				echo $this->show(2001);
			}
		}
	}
	/**
	 * 转义符号emoji
	 * @return [type] [description]
	 */
	public function emoji(){
		if(request()->isAjax()){
			$res = emoji_encode(input('emoji'));
			//$res =input('emoji');
			if($res){
				echo $this->show(1001,'成功',['data'=>$res]);
			}else{
				echo $this->show(2001);
			}
		}
	}
	/**
	 * 是否手机访问
	 * @return [type] [description]
	 */
	public function phone(){

		if(request()->isAjax()){
			$res = is_mobile();
			if($res){
				echo $this->show(1001,'是手机访问',['data'=>$res]);
			}else{
				echo $this->show(2001,'不是手机访问');
			}
		}
	}
	/**
	 * 获取当前设备类型
	 * @return [type] [description]
	 */
	public function device(){
		if(request()->isAjax()){
			$res = get_device_type();
			if($res == 1){
				echo $this->show(1001,'成功',['data'=>'其他']);
			}elseif($res == 2){
				echo $this->show(1001,'成功',['data'=>'iOS']);
			}elseif($res == 3){
				echo $this->show(1001,'成功',['data'=>'Android']);
			}
		}
	}
	/**
	 * 生成不重复的随机数
	 * @return [type] [description]
	 */
	public function randnum(){
		if(request()->isAjax()){
			$start = input('start')?input('start'):1;
			$end = input('end')?input('end'):10;
			$leng = input('leng')?input('leng'):4;
			$res = get_rand_number($start,$end,$leng);
			if($res){
				echo $this->show(1001,'成功',['data'=>$res]);
			}else{
				echo $this->show(2001);
			}
		}
	}
	/**
	 * 生成多个不重复随机数
	 * @return [type] [description]
	 * 0 小写字母 1大写字母 2 数字 3大小写 4小写与数字 5大写与数字  其它 混合
	 */
	public function morenum(){
		if(request()->isAjax()){
			$num = input('num')?input('num'):1;
			$leng = input('leng')?input('leng'):4;
			$model = input('model')?input('model'):1;
			$res = build_count_rand($num,$leng,$model);
			if($res){
				echo $this->show(1001,'成功',['data'=>$res]);
			}else{
				echo $this->show(2001);
			}
		}
	}
	/**
	 * 获取一定范围随机数字
	 * @return [type] [description]
	 */
	public function fannum(){
		
		if(request()->isAjax()){
			$st = input('st')?input('st'):1;
			$et = input('et')?input('et'):9999;
			$res = rand_number($st,$et);
			if($res){
				echo $this->show(1001,'成功',['data'=>$res]);
			}else{
				echo $this->show(2001);
			}
		}
	}
	/**
	 * 按符号截取字符串的指定部分
	 * @return [type] [description]
	 */
	public function cutstr(){

		if(request()->isAjax()){
			$str = input('str');
			$sign = input('si');
			$number = input('number');
			$res = cut_str($str,$sign,$number);
			if($res){
				echo $this->show(1001,'成功',['data'=>$res]);
			}else{
				echo $this->show(2001);
			}
		}
	}
	/**
	 * 取得根域名
	 * @return [type] [description]
	 */
	public function demaio(){
		if(request()->isAjax()){
			$demaio = input('demaio');
			$res = get_url_to_domain($demaio);
			if($res){
				echo $this->show(1001,'成功',['data'=>$res]);
			}else{
				echo $this->show(2001);
			}
		}
	}
	/**
	 * 字符串截取，支持中文和其他编码
	 * @param string $str 需要转换的字符串
	 * @param string $start 开始位置
	 * @param string $length 截取长度
	 * @param string $suffix 截断显示字符
	 * @param string $charset 编码格式
	 * @return string
	 */
	public function substrs(){

		if(request()->isAjax()){
			$str = input('str3');
			$start = input('start3');
			$length = input('length3');
			$suffix = input('suffix3');
			$charset = input('charset3');
			$res = re_substr($str,$start,$length,$suffix,$charset);
			if($res){
				echo $this->show(1001,'成功',['data'=>$res]);
			}else{
				echo $this->show(2001);
			}
		}
	}
	/**
	 * 传递ueditor内容获取图片路径
	 * @return [type] [description]
	 */
	public function ueimages(){

		if(request()->isAjax()){
			$str4 = input('str4');
			$res = get_ueditor_image_path($str4);
			if($res){
				echo $this->show(1001,'成功',['data'=>$res]);
			}else{
				echo $this->show(2001);
			}
		}
	}


	/**
	 * 计算距离现在的时间
	 * @return [type] [description]
	 */
	public function fortime(){
		if(request()->isAjax()){
			$time = strtotime(input('fortime').' '.input('fortime1'));
			$res = word_time($time);
			if($res){
				echo $this->show(1001,'成功',['data'=>$res]);
			}else{
				echo $this->show(2001);
			}
		}
	}


	/**
	 * 产生唯一名称
	 * @return [type] [description]
	 */
	public function uniqidName(){
		
		if(request()->isAjax()){
			$length4 = input('length4')?input('length4'):10;
			$res = getUniqidName($length4);
			if($res){
				echo $this->show(1001,'成功',['data'=>$res]);
			}else{
				echo $this->show(2001);
			}
		}
	}

	/**
	 * 截取文件扩展名
	 * @return [type] [description]
	 */
	public function getExt(){
		return $this->fetch();
	}

	/**
	 * 提示操作信息的，并且跳转
	 * @return [type] [description]
	 */
	public function alerts(){
		
		if(request()->isAjax()){
			$msg = input('msg');
			$url = input('url');
			$res = alertMes($msg,$url);
			if($res){
				echo $this->show(1001,'成功',['data'=>$res]);
			}else{
				echo $this->show(2001);
			}
		}
	}




}