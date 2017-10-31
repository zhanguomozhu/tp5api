<?php 
namespace app\admin\controller;
use app\base\controller\Base;

class Funs extends Base
{
	/**
	 * 发送邮件
	 * @return [type] [description]
	 */
	public function email(){
		return $this->fetch();
	}

	/**
	 * 发送邮件
	 * @return [type] [description]
	 */
	public function sendEmail(){
		if(request()->isAjax()){
			//数据库字段 网页字段转换，过滤参数
            $param = [
            	'email' 	=>'email',
                'title' => 'title',
                'content' 	=> 'content',
            ];
            $param_data = $this->buildParam($param);
            //发送邮件
            $res = $this->email->send($param_data['email'],$param_data['title'],$param_data['content']);
            if($res){
				echo $this->show(1001);
			}else{
				echo $this->show(2001);
			}
		}
	}





	/**
	 * 云之讯发送短信
	 * @return [type] [description]
	 */
	public function sms(){
		return $this->fetch();
	}

	/**
	 * 阿里大鱼发送短信
	 * @return [type] [description]
	 */
	public function sms1(){
		return $this->fetch();
	}


	//云之讯短信验证码
    public function sendY(){
       if(request()->isAjax()){
	        //随机生成6位验证码
	        $authnum='';
	        srand((double)microtime()*1000000);//create a random number feed.
	        $ychar="0,1,2,3,4,5,6,7,8,9";
	        //$ychar="0,1,2,3,4,5,6,7,8,9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z";
	        $list=explode(",",$ychar);
	        for($i=0;$i<6;$i++){
		        //$randnum=rand(0,35); // 10+26;
		        $randnum=rand(0,9); // 10+26;
		        $authnum.=$list[$randnum];
	        }
	        
	        //短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
	        $appId = config('ysms.appid');  			//appId
	        $phone = input('phone');				//手机号
	        $templateId = config('ysms.templateid');	//模板id
	        $param=$authnum;							//验证码
	        //把生成的验证码拼接手机号生成md5码存储到session***用于ajax验证***********************************【重要】
	 		//加密手机和验证码
	 		
	 		session($phone.'_sms',md5($phone.$param));
	 		//发送验证码
	        $arr=$this->ucpaas->templateSMS($appId,$phone,$templateId,$param);
	        if (substr($arr,21,6) == 000000) {
	            //如果成功就，这里只是测试样式，可根据自己的需求进行调节
	            echo $this->show(1050);  
	        }else{
	            //如果不成功
	            echo $this->show(1051);    
	        }
    	}
    }



    //阿里大鱼短信验证码
    public function sendA(){
    	if(request()->isAjax()){
    		$phone = input('phone'); 					//手机号
    		$content = input('content');				//内容
    		$this->alidayu->appkey = config('asms.appkey'); 	//appkey
	        $this->alidayu->secretKey = config('asms.secretKey');//secretKey
	        $req = new \AlibabaAliqinFcSmsNumSendRequest();
	        $req->setSmsType("normal");	//镀锌业务参数
	        $req->setSmsFreeSignName(config('asms.FreeSignName'));//你在阿里大于设置的那个
	        $req->setSmsParam("{code:'".$content."'}");//我只是用来做验证码，因此只有这一个
	        $req->setRecNum($phone);//手机号码
	        $req->setSmsTemplateCode(config('asms.smsTemplateCode'));//自己的编号
	        $res = $this->alidayu->execute($req);
	        // dump($res);
	        // dump($res->code);
	        // die;
	        if (isset($res->err_code) && $res->err_code == 0) {
	           //如果成功就，这里只是测试样式，可根据自己的需求进行调节
	           echo $this->show(1050);  
	        }else{
	            //如果不成功
	            echo $this->show(1051,$res->msg);    
	        }
    	}
        
    }


    /**
     * 二维码
     * @return [type] [description]
     */
    public function qrCode()
	{
       return $this->fetch();
	}


	/**
	 * 生成二维码
	 */
	public function setQrCode1()
	{
		if(request()->isAjax()){
			//引入二维码类
			Vendor('phpqrcode.phpqrcode');
			$object = new \QRcode();//实例化二维码类
			$url=input('httpURL');//网址或者是文本内容
			$level=3;
			$size=4;
			$pathname ="./qrcode";
			if(!is_dir($pathname)) { //若目录不存在则创建之
				mkdir($pathname);
			}
			$ad = $pathname . "/qrcode_" . rand(10000,99999) . ".png";
			$errorCorrectionLevel =intval($level) ;//容错级别
			$matrixPointSize = intval($size);//生成图片大小
			$object->png($url, $ad, $errorCorrectionLevel, $matrixPointSize, 2);
			echo $this->show(1001,'生成二维码成功',['qrcode'=>substr($ad,1,-1).substr($ad,-1)]);
		}
	}



	/**
     * 二维码
     * @return [type] [description]
     */
    public function qrCode1()
	{
       return $this->fetch();
	}


	/**
	 * 生成二维码2更详细
	 */
	public function setQrCode2()
	{
		if(request()->isAjax()){
			$data = input();
			//生成二维码图片
			$qrCode = new  \Endroid\QrCode\QrCode();//实例化二维码类
			//生成二维码的各项参数
			//设置版本号，QR码符号共有40种规格的矩阵，从21x21（版本1），到177x177（版本40），每一版本符号比前一版本 每边增加4个模块。
			//$setVersion = $qrCode -> setVersion(5);//37*37
			$setVersion = $qrCode -> setVersion($data['qversion']);//37*37
			//容错级别,2的容错率:30%,容错级别：0：15%，1：7%，2：30%，3：25%
			//$setErrorCorrection = $qrCode -> setErrorCorrection(2);
			$setErrorCorrection = $qrCode -> setErrorCorrection($data['qerror']);
			//设置QR码模块大小
			//$setModuleSize = $qrCode -> setModuleSize(2);
			$setModuleSize = $qrCode -> setModuleSize($data['qmsize']);
			//设置二维码保存类型
			//$setImageType = $qrCode -> setImageType('png');
			$setImageType = $qrCode -> setImageType($data['qtype']);
			//logo图片
			//$logo = 'uploads/accountPictrue/logo1.jpg';
			$logo = $data['qlogo'];
			//二维码中间的图片
			$setLogo = $qrCode -> setLogo($logo);
			//二维码内容
			//$value = 'https://www.dongtianjr.com';
			$value = $data['httpURL'];
			//设置文字以隐藏QR码。
			$setText = $qrCode -> setText($value);
			//二维码生成后的大小
			//$setSize = $qrCode -> setSize(1024);
			$setSize = $qrCode -> setSize($data['qsize']);
			//设置二维码的边框宽度，默认16
			//$setPadding = $qrCode -> setPadding(48);
			$setPadding = $qrCode -> setPadding($data['qwidth']);
			//设置模块间距
			//$setDrawQuietZone = $qrCode -> setDrawQuietZone(true);
			$setDrawQuietZone = $qrCode -> setDrawQuietZone($data['qpadding']);
			//给二维码加边框。。。
			//$setDrawBorder = $qrCode -> setDrawBorder(true);
			$setDrawBorder = $qrCode -> setDrawBorder($data['qborder']);
			//在生成的图片下面加上文字
			//$text = 'XX销售，XX公司！一二';
			$text = $data['qtagtext'];
			$setLabel = $qrCode -> setLabel($text);
			//生成的文字大小、
			//$setLabelFontSize = $qrCode -> setLabelFontSize(39);
			$setLabelFontSize = $qrCode -> setLabelFontSize($data['qtagsize']);
			//设置标签字体
			//$lablePath = 'uploads/qr/qr.TTF';
			$lablePath = $data['qtagfont'];
			$setLabelFontPath = $qrCode -> setLabelFontPath($lablePath);
			//生成的二维码的颜色
			//$color_foreground = ['r' => 108, 'g' => 182, 'b' => 229, 'a' => 0];
			$color_foreground = ['r' => $data['qr'], 'g' =>$data['qg'], 'b' => $data['qb'], 'a' =>$data['qa']];
			$setForegroundColor = $qrCode -> setForegroundColor($color_foreground);
			//生成的图片背景颜色
			//$color_background = ['r' => 213, 'g' => 241, 'b' => 251, 'a' => 0];
			$color_background = ['r' => $data['br'], 'g' => $data['bg'], 'b' => $data['bb'], 'a' => $data['ba']];
			$setBackgroundColor = $qrCode -> setBackgroundColor($color_background);
			//二维码的名字
			//$flieName = 'liukelk.jpg';
			$flieName = $data['qname'];
			//生成二维码
			$res = $qrCode -> save($flieName);
			//注：如果标签的中文乱码的话，可以引入中文字体。
			if($res){
				echo $this->show(1001,'生成二维码成功',['qrcode'=>substr($flieName,1)]);
			}else{
				echo $this->show(2001,'生成二维码失败');
			}
		}
	}



	/**
	 * 拼音
	 * @return [type] [description]
	 */
	public function pinyin(){
		return $this->fetch();
	}


	/**
	 * 转换拼音
	 * @return [type] [description]
	 */
	public function sendhan(){
		if(request()->isAjax()){
			$type = input('type');
			if($type == 1){
				$res = $this->pinyin->encode(trim(input('han')));
			}

			if($type == 2){
				$res = $this->pinyin->encode(trim(input('han')),'all');
			}

			if($res){
				echo $this->show(1001,'转换成功',['data'=>$res]);
			}else{
				echo $this->show(2001,'转换失败');
			}
		}
	}

    /**
     * @return 地图
     */
	public  function  map(){
	    return $this->fetch();
    }


	/**
	 * 地图定位
	 * @return [type] [description]
	 */
	public function getmap($address)
    {
    	return $this->map->staticimage($address);
    }

    /**
     * @return 显示地图
     */
    public function showmap($address = '上海金桥路地铁站')
    {
        return '<img style="margin:20px" width="1000" height="800" src="'.url('getmap',['address'=>$address]).'"/>';
    }

    /**
	 * type=1根据地址查询经纬度，type=2根据经纬度或者地址来获取百度地图
	 * @return [type] [description]
	 */
	public function sendMap(){
		if(request()->isAjax()){
			$type = input('type');
			if($type == 1){
				$res = $this->map->getLngLat(input('lnglat'));
				if($res){
					echo $this->show(1001,'获取成功',['data'=>$res]);
				}else{
					echo $this->show(2001,'获取失败');
				}
			}

			if($type == 2){
				echo $this->show(1001,'获取成功',['data'=>url('showmap',['address'=>input('address')])]);
			}

			
		}
	}
}