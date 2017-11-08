<?php 
namespace app\common\model;
use app\base\model\Base;
class Url extends Base
{

	/**
	 * 插入数据库，返回短连接
	 * @param  [type] $info [插入信息]
	 * @param  [type] $num  [短链个数]
	 * @return [type]       [短链]
	 */
	public	function create_info($info,$num){//传入值
		$save['uid']=$info['uid'];
		$save['original']=$info['original'];
		$save['short']=$this->random_short($num);
		$save['ip']=$info['ip'];
		$res = $this->save($save);
		if($res){
			return $save['short'];
		}else{
			return false;
		}
		
	}

	/**
	 * 生成随机码
	 * @param  [type] $num [长度]
	 * @return [type]      [description]
	 */
	public	function random_short($num){
		if(isset($num)){
			if((int)$num<=4){
				$num=4;
			}
		}else{
			$num=4;
		}
		$str="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$short="";
		for ($i=0; $i < $num; $i++) { 
			$mt=mt_rand(0,61);
			$short=$short.$str[$mt];
		}
		$res=$this->is_short($short);
		if($res){
			$this->random_short();
		}else{
			return $short;
		}		
	}

	/**
	 * 查看是否存在短链
	 * @param  [type]  $short [短链]
	 * @return boolean        [description]
	 */
	public	function is_short($short){
		$where['short']=$short;
		$res=$this->where($where)->select();
		if($res){
			return $res;
		}else{
			return false;
		}
	}

	/**
	 * 用short去匹配信息
	 * @param  [type] $short [短链]
	 * @return [type]        [description]
	 */
	public	function short_key($short){
		$where['short']=$short;
		$res=$this->where($where)->select();
		if($res){
			return $res[0]->data;
		}else{
			return false;
		}
	}

	/**
	 * 短链点击信息修改
	 * @param  [type] $info [修改的信息]
	 * @return [type]       [description]
	 */
	public	function click($info){//访问信息[short,ip]
		//查看是否有此链接
		$noke=$this->short_key($info['short']);
		//插入点击信息
		if($noke){
			$info_array=json_decode($noke['visitor'],true);
			$info['time']=time();
			$info_array[]=$info;
			$noke['click']=$noke['click']+1;
			$noke['visitor']=json_encode($info_array);
			$this->update($noke);
			return $noke['original'];
		}else{
			return false;
		}
	}

	/**
	 * 通过IP查询信息
	 * @param  [type] $ip [ip]
	 * @return [type]     [description]
	 */
	public	function ip_select($ip){//IP查询
		$where['ip']=$ip;
		$res_ip=$this->where($where)->select();
		if($res_ip){
			$re['status']=true;
			$re['con']=$res_ip->data;
		}else{
			$re['status']=false;
			$re['con']="无该IP信息";
		}
	}
}