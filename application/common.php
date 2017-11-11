<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
header("Content-type:text/html;charset=utf-8");

/**
 * 异位或加密字符串
 * @param  [string]  $value [需要加密的字符串]
 * @param  integer $type  	[加密或解密（0：加密，1：解密）]
 * @return [string]         	[加密或解密后字符串]
 */
function enctypetion($value, $type=0){
	$key = config('sfun.enctypetion_key');
	if(!$type){
		return str_replace('=','',base64_encode($value ^ $key));
	}

	$value = base64_decode($value);
	return $value ^ $key;
}


/**
 * 加密解密base64和MD5加密和解密。
 * @param  [type] $key     [description]
 * @param  [type] $string  [description]
 * @param  [type] $decrypt [description]
 * //加密： 
 * echo encryptDecrypt('password', 'Helloweba欢迎您',0); 
 * //解密： 
 * echo encryptDecrypt('password', 'z0JAx4qMwcF+db5TNbp/xwdUM84snRsXvvpXuaCa4Bk=',1);
 */
function encryptDecrypt($key, $string, $decrypt){ 
    if($decrypt){ 
        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "12"); 
        return $decrypted; 
    }else{ 
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key)))); 
        return $encrypted; 
    } 
}


/**
 * 字符串与二进制互转
 * @param [type] $str  [字符串]
 * @param [type] $type [0，字符串转二进制，1，二进制转字符串]
 */
function StrToBin($str,$type){
    if(!$type){
        //1.列出每个字符
        $arr = preg_split('/(?<!^)(?!$)/u', $str);
        //2.unpack字符
        foreach($arr as &$v){
            $temp = unpack('H*', $v);
            $v = base_convert($temp[1], 16, 2);
            unset($temp);
        }
        return join(' ',$arr);
    }else{
        $arr = explode(' ', $str);
        foreach($arr as &$v){
            $v = pack("H".strlen(base_convert($v, 2, 16)), base_convert($v, 2, 16));
        }
      
        return join('', $arr);
    }
}




/**
 * PHP防止SQL注入
 * @param  [type] $sql_str [description]
 * @return [type]          [description]
 * echo injCheck('1 or 1=1');
 */
function injCheck($sql_str) {  
    $check = preg_match("/select|insert|update|delete|'|/*|*|../|./|union|into|load_file|outfile/", $sql_str);
    if ($check) { 
        echo '非法字符！！'; 
        exit; 
    } else { 
        return $sql_str; 
    } 
}

/**
 * 列出目录下的文件名
 * @param  [type] $DirPath [description]
 * @return [type]          [description]
 */
function listDirFiles($DirPath){ 
    if($dir = opendir($DirPath)){ 
         while(($file = readdir($dir))!== false){ 
                if(!is_dir($DirPath.$file)) 
                { 
                    echo "filename: $file<br />"; 
                } 
         } 
    } 
}


/**
 * 正则去除PHP代码注释
 * @param string $content 代码内容
 * @return string 去除注释之后的内容
 */
function removeComment($content){
  return preg_replace("/(\/\*.*\*\/)|(#.*?\n)|(\/\/.*?\n)/s", '', str_replace(array("\r\n", "\r"), "\n", $content));
}



/**
 * 去除代码中的空白和注释
 * @param string $content 代码内容
 * @return string
 */
function strip_whitespace($content) {
    $stripStr   = '';
    //分析php源码
    $tokens     = token_get_all($content);
    $last_space = false;
    for ($i = 0, $j = count($tokens); $i < $j; $i++) {
        if (is_string($tokens[$i])) {
            $last_space = false;
            $stripStr  .= $tokens[$i];
        } else {
            switch ($tokens[$i][0]) {
                //过滤各种PHP注释
                case T_COMMENT:
                    break;
                case T_DOC_COMMENT:
                    break;
                //过滤空格
                case T_WHITESPACE:
                    if (!$last_space) {
                        $stripStr  .= ' ';
                        $last_space = true;
                    }
                    break;
                case T_START_HEREDOC:
                    $stripStr .= "<<<THINK\n";
                    break;
                case T_END_HEREDOC:
                    $stripStr .= "THINK;\n";
                    for($k = $i+1; $k < $j; $k++) {
                        if(is_string($tokens[$k]) && $tokens[$k] == ';') {
                            $i = $k;
                            break;
                        } else if($tokens[$k][0] == T_CLOSE_TAG) {
                            break;
                        }
                    }
                    break;
                default:
                    $last_space = false;
                    $stripStr  .= $tokens[$i][1];
            }
        }
    }
    return $stripStr;
}


/**
 * 批量修改内容
 * @param  [type] $dir      [文件夹路径]
 * @param  array  $research [修改的]
 * @param  array  $replace  [替换的]
 * @return [type]           [description]
 */
function find_all_dir( $dir,$research=array(), $replace=array()){
    //找到目录下的所有文件：
    $dh = opendir( $dir );
    while ( $file = readdir( $dh ) ) {
        if ( $file != "." && $file != ".." ) {
            $fullpath = $dir . "/" . $file;
            if ( !is_dir( $fullpath ) ) {
                $f=fopen($fullpath, 'r');
                $text=fread($f, filesize($fullpath));
                //对内容进行修改
                $text=str_replace($research, $replace , $text);
                //判断结果
                $result=file_put_contents($fullpath, $text);
            } else {
                find_all_dir( $fullpath, $research, $replace );
            }
        }
    }
    closedir( $dh );
}


/**
 * 简单的 php 防注入、防跨站 函数
 * @return String
 */
function fn_safe($str_string) {
    //直接剔除
    $_arr_dangerChars = array(
        "|", ";", "$", "@", "+", "\t", "\r", "\n", ",", "(", ")", PHP_EOL //特殊字符
    );
 
    //正则剔除
    $_arr_dangerRegs = array(
        /* -------- 跨站 --------*/
 
        //html 标签
        "/<(script|frame|iframe|bgsound|link|object|applet|embed|blink|style|layer|ilayer|base|meta)\s+\S*>/i",
 
        //html 属性
        "/on(afterprint|beforeprint|beforeunload|error|haschange|load|message|offline|online|pagehide|pageshow|popstate|redo|resize|storage|undo|unload|blur|change|contextmenu|focus|formchange|forminput|input|invalid|reset|select|submit|keydown|keypress|keyup|click|dblclick|drag|dragend|dragenter|dragleave|dragover|dragstart|drop|mousedown|mousemove|mouseout|mouseover|mouseup|mousewheel|scroll|abort|canplay|canplaythrough|durationchange|emptied|ended|error|loadeddata|loadedmetadata|loadstart|pause|play|playing|progress|ratechange|readystatechange|seeked|seeking|stalled|suspend|timeupdate|volumechange|waiting)\s*=\s*(\"|')?\S*(\"|')?/i",
 
        //html 属性包含脚本
        "/\w+\s*=\s*(\"|')?(java|vb)script:\S*(\"|')?/i",
 
        //js 对象
        "/(document|location)\s*\.\s*\S*/i",
 
        //js 函数
        "/(eval|alert|prompt|msgbox)\s*\(.*\)/i",
 
        //css
        "/expression\s*:\s*\S*/i",
 
        /* -------- sql 注入 --------*/
 
        //显示 数据库 | 表 | 索引 | 字段
        "/show\s+(databases|tables|index|columns)/i",
 
        //创建 数据库 | 表 | 索引 | 视图 | 存储过程 | 存储过程
        "/create\s+(database|table|(unique\s+)?index|view|procedure|proc)/i",
 
        //更新 数据库 | 表
        "/alter\s+(database|table)/i",
 
        //丢弃 数据库 | 表 | 索引 | 视图 | 字段
        "/drop\s+(database|table|index|view|column)/i",
 
        //备份 数据库 | 日志
        "/backup\s+(database|log)/i",
 
        //初始化 表
        "/truncate\s+table/i",
 
        //替换 视图
        "/replace\s+view/i",
 
        //创建 | 更改 字段
        "/(add|change)\s+column/i",
 
        //选择 | 更新 | 删除 记录
        "/(select|update|delete)\s+\S*\s+from/i",
 
        //插入 记录 | 选择到文件
        "/insert\s+into/i",
 
        //sql 函数
        "/load_file\s*\(.*\)/i",
 
        //sql 其他
        "/(outfile|infile)\s+(\"|')?\S*(\"|')/i",
    );
 
    $_str_return = $str_string;
    //$_str_return = urlencode($_str_return);
 
    foreach ($_arr_dangerChars as $_key=>$_value) {
        $_str_return = str_ireplace($_value, "", $_str_return);
    }
 
    foreach ($_arr_dangerRegs as $_key=>$_value) {
        $_str_return = preg_replace($_value, "", $_str_return);
    }
 
    $_str_return = htmlentities($_str_return, ENT_QUOTES, "UTF-8", true);
 
    return $_str_return;
}


/**
 * 提示操作信息的，并且跳转
 * @param string $mes
 * @param string $url
 */
function alertMes($mes,$url){
	return "<script type='text/javascript'>alert('{$mes}');location.href='{$url}';</script>";
}

/**
 * 截取文件扩展名
 * @param string $filename
 * @return string
 */
function getExt($filename){
	return strtolower(pathinfo($filename,PATHINFO_EXTENSION));
}

/**
 * 产生唯一名称
 * @param int $length
 * @return string
 */
function getUniqidName($length=10){
	return substr(md5(uniqid(microtime(true),true)),0,$length);
}

/**
 * PHP获取文件大小并格式化
 * @param  [type] $size [description]
 * @return [type]       [description]
 * $thefile = filesize('test_file.mp3'); 
 * echo formatSize($thefile);
 */
function formatSize($size) { 
    $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB"); 
    if ($size == 0) {  
        return('n/a');  
    } else { 
      return (round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]);  
    } 
}

/**
 * 替换标签字符
 * @param  [type] $string   [description]
 * @param  [type] $replacer [description]
 * @return [type]           [description]
 * $string = 'The {b}anchor text{/b} is the {b}actual word{/b} or words used {br}to describe the link {br}itself'; 
 * $replace_array = array('{b}' => '<b>','{/b}' => '</b>','{br}' => '<br />'); 
 * echo stringParser($string,$replace_array);
 */
function stringParser($string,$replacer){ 
    $result = str_replace(array_keys($replacer), array_values($replacer),$string); 
    return $result; 
}



/**
 * curl获取数据
 * @param  [type]  $url  [description]
 * @param  integer $type [0 get ,1 post]
 * @param  array   $data [description]
 * @return [type]        [description]
 */
function doCurl($url,$type=0,$data=[])
{
	
  	//初始化curl
    $ch = curl_init();  
    /* cURL 设置 */  
    curl_setopt($ch, CURLOPT_URL, $url);  
  	//超时设置
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);  
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);  
  	//0 不需要输出header头
    curl_setopt($ch, CURLOPT_HEADER, 0);  
  	//返回结果不输出
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //post请求  
    if ($type == 1) {  
        curl_setopt($ch, CURLOPT_POST, true);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
    } 
    //执行并获取数据
    $result = curl_exec($ch);
    //释放curl句柄
    curl_close($ch);  
  
    return $result;  
}

/**
 * 使用代理进行curl抓取
 * @return [type] [description]
 */
function  curl_proxy(){
    $ch= curl_init(); 
    curl_setopt($ch, CURLOPT_URL,"http://blog.51yip.com"); 
    curl_setopt($ch, CURLOPT_HEADER, false); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, TRUE); 
    curl_setopt($ch, CURLOPT_PROXY, '125.21.23.6:8080'); 
    //url_setopt($ch, CURLOPT_PROXYUSERPWD, 'user:password');如果要密码的话，加上这个 
    $result=curl_exec($ch); 
    curl_close($ch); 
    return $result;
}



/**
 * 抓取一些有页面访问控制的页面
 * @return [type] [description]
 */
function  curl_active(){
     $ch= curl_init(); 
     curl_setopt($ch, CURLOPT_URL,"http://club-china"); 
     /*CURLOPT_USERPWD主要用来破解页面访问控制的
     *例如平时我们所以htpasswd产生页面控制等。*/
     //curl_setopt($ch, CURLOPT_USERPWD, '231144:2091XTAjmd='); 
     curl_setopt($ch, CURLOPT_HTTPGET, 1); 
     curl_setopt($ch, CURLOPT_REFERER,"http://club-china"); 
     curl_setopt($ch, CURLOPT_HEADER, 0); 
     $result=curl_exec($ch); 
     curl_close($ch); 
     return $result;
}




/**
 * curl远程下载文件
 * @return [type] [远程文件路径]
 * return 1 or 0
 * $url = 'http://xxx/TGPMiniLoader.2.16.0.4749.tgpgw.exe';
 */
function curl_upload($url){
    //获取下载文件名称
    $fileName = basename($url);
    $handle = fopen('./'.$fileName,'w');
    //初始化curl
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_FILE, $handle);
    //执行会话
    curl_exec($ch);
    //关闭curl
    curl_close($ch);
    //使用curl下载
    exec("curl".$url, $out, $status);
    return $status;
}


/**
 * 强制下载文件
 * @param  [type] $filename [description]
 * @return [type]           [description]
 */
function download($filename){ 
    if ((isset($filename))&&(file_exists($filename))){ 
       header("Content-length: ".filesize($filename)); 
       header('Content-Type: application/octet-stream'); 
       header('Content-Disposition: attachment; filename="' . $filename . '"'); 
       readfile("$filename"); 
    } else { 
       echo "Looks like file does not exist!"; 
    } 
}



/**
 * 下载
 * @param [type] $filename [description]
 * @param string $dir  [description]
 * @return [type]   [description]
 */
function downloads($filename,$dir='./'){
     $filepath = $dir.$filename;
     if (!file_exists($filepath)){
        header("Content-type: text/html; charset=utf-8");
        echo "File not found!";
        exit;
     }else{
        $file = fopen($filepath,"r");
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Accept-Length: ".filesize($filepath));
        Header("Content-Disposition: attachment; filename=".$filename);
        echo fread($file, filesize($filepath));
        fclose($file);
     }
}

/**
 * 使用二分法查找某个值
 * @param $start 开始位置
 * @param $len 数组长度
 * @param $data 要查询的数组
 * @param $value 要查询的值
 * @return bool|false 成功返回查询到的值的下标，否则返回false
 * //声明一个数组
 * $data = [2,3,4,5];
 * //获取数组长度
 * $len = count($data)-1;
 * echo search(0, $len, $data,5);
 * 3
 */
function search($start, $len, $data,$search)
{
    while($start <= $len )
    {
        $mid = floor(($start + $len)/2);
        if($data[$mid] == $search){
            return $mid;
        }elseif ($data[$mid] < $search){
            $start = $mid+1;
        }else{
            $len = $mid-1;
        }
    }
    return false;
}

/**
 * 获取当前页面URL
 * @return [type] [description]
 */
function curPageURL() { 
    $pageURL = 'http'; 
    if (!empty($_SERVER['HTTPS'])) {$pageURL .= "s";} 
    $pageURL .= "://"; 
    if ($_SERVER["SERVER_PORT"] != "80") { 
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; 
    } else { 
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; 
    } 
    return $pageURL; 
}

/**
 * 发送邮件
 * @param  string $address 需要发送的邮箱地址 发送给多个地址需要写成数组形式
 * @param  string $subject 标题
 * @param  string $content 内容
 * @return boolean       是否成功
 */
function send_email1($address,$subject,$content){
    $email_smtp=config('email.email_smtp');
    $email_username=config('email.email_username');
    $email_password=config('email.email_password');
    $email_from_name=config('email.email_from_name');
    $email_smtp_secure=config('email.email_smtp_secure');
    $email_port=config('email.email_port');
    if(empty($email_smtp) || empty($email_username) || empty($email_password) || empty($email_from_name)){
        return array("error"=>1,"message"=>'邮箱配置不完整');
    }
    require_once '../extend/phpmail/class.phpmailer.php';
    require_once '../extend/phpmail/class.smtp.php';
    $phpmailer=new \Phpmailer();
    // 设置PHPMailer使用SMTP服务器发送Email
    $phpmailer->IsSMTP();
    // 设置设置smtp_secure
    $phpmailer->SMTPSecure=$email_smtp_secure;
    // 设置port
    $phpmailer->Port=$email_port;
    // 设置为html格式
    $phpmailer->IsHTML(true);
    // 设置邮件的字符编码'
    $phpmailer->CharSet='UTF-8';
    // 设置SMTP服务器。
    $phpmailer->Host=$email_smtp;
    // 设置为"需要验证"
    $phpmailer->SMTPAuth=true;
    // 设置用户名
    $phpmailer->Username=$email_username;
    // 设置密码
    $phpmailer->Password=$email_password;
    // 设置邮件头的From字段。
    $phpmailer->From=$email_username;
    // 设置发件人名字
    $phpmailer->FromName=$email_from_name;
    // 添加收件人地址，可以多次使用来添加多个收件人
    if(is_array($address)){
        foreach($address as $addressv){
            $phpmailer->AddAddress($addressv);
        }
    }else{
        $phpmailer->AddAddress($address);
    }
    // 设置邮件标题
    $phpmailer->Subject=$subject;
    // 设置邮件正文
    $phpmailer->Body=$content;
    // 发送邮件。
    if(!$phpmailer->Send()) {
        $phpmailererror=$phpmailer->ErrorInfo;
        return array("error"=>1,"message"=>$phpmailererror);
    }else{
        return array("error"=>0);
    }
}


/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @param boolean $adv 是否进行高级模式获取（有可能被伪装） 
 * @return mixed
 */
function get_client_ip($type = 0,$adv=false) {
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if($adv){
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos    =   array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip     =   trim($arr[0]);
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}


//获取用户真实IP 
function getIp() { 
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
        $ip = getenv("HTTP_CLIENT_IP"); 
    else 
        if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
            $ip = getenv("HTTP_X_FORWARDED_FOR"); 
        else 
            if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
                $ip = getenv("REMOTE_ADDR"); 
            else 
                if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
                    $ip = $_SERVER['REMOTE_ADDR']; 
                else 
                    $ip = "unknown"; 
    return ($ip); 
}

/**
 * 获取在线IP
 * @return String
 */
function getOnlineIp($format=0) {
     global $S_GLOBAL;
     if(empty($S_GLOBAL['onlineip'])) {
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
        $onlineip = getenv('HTTP_CLIENT_IP');
      }elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
        $onlineip = getenv('HTTP_X_FORWARDED_FOR');
      }elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
        $onlineip = getenv('REMOTE_ADDR');
      }elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
        $onlineip = $_SERVER['REMOTE_ADDR'];
      }
        preg_match("/[\d\.]{7,15}/", $onlineip, $onlineipmatches);
        $S_GLOBAL['onlineip'] = $onlineipmatches[0] ? $onlineipmatches[0] : 'unknown';
     }
     
     if($format) {
        $ips = explode('.', $S_GLOBAL['onlineip']);
        for($i=0;$i<3;$i++) {
            $ips[$i] = intval($ips[$i]);
        }
        return sprintf('%03d%03d%03d', $ips[0], $ips[1], $ips[2]);
     } else {
            return $S_GLOBAL['onlineip'];
     }
}

/**
 * 随机生成国内ip地址
 * @return [type] [description]
 */
function randIp()
{
    $ip_long = array(
        array('607649792', '608174079'), // 36.56.0.0-36.63.255.255
        array('1038614528', '1039007743'), // 61.232.0.0-61.237.255.255
        array('1783627776', '1784676351'), // 106.80.0.0-106.95.255.255
        array('2035023872', '2035154943'), // 121.76.0.0-121.77.255.255
        array('2078801920', '2079064063'), // 123.232.0.0-123.235.255.255
        array('-1950089216', '-1948778497'), // 139.196.0.0-139.215.255.255
        array('-1425539072', '-1425014785'), // 171.8.0.0-171.15.255.255
        array('-1236271104', '-1235419137'), // 182.80.0.0-182.92.255.255
        array('-770113536', '-768606209'), // 210.25.0.0-210.47.255.255
        array('-569376768', '-564133889'), // 222.16.0.0-222.95.255.255
        );
    $rand_key = mt_rand(0, 9);
    return $ip = long2ip(mt_rand($ip_long[$rand_key][0], $ip_long[$rand_key][1]));
} 




/**
 * 友好提示并跳转
 * @param  [type] $msgTitle [description]
 * @param  [type] $message  [description]
 * @param  [type] $jumpUrl  [description]
 * @return [type]           [description]
 */
function message($msgTitle,$message,$jumpUrl){ 
    $str = '<!DOCTYPE HTML>'; 
    $str .= '<html>'; 
    $str .= '<head>'; 
    $str .= '<meta charset="utf-8">'; 
    $str .= '<title>页面提示</title>'; 
    $str .= '<style type="text/css">'; 
    $str .= '*{margin:0; padding:0}a{color:#369; text-decoration:none;}a:hover{text-decoration:underline}body{height:100%; font:12px/18px Tahoma, Arial,  sans-serif; color:#424242; background:#fff}.message{width:450px; height:120px; margin:16% auto; border:1px solid #99b1c4; background:#ecf7fb}.message h3{height:28px; line-height:28px; background:#2c91c6; text-align:center; color:#fff; font-size:14px}.msg_txt{padding:10px; margin-top:8px}.msg_txt h4{line-height:26px; font-size:14px}.msg_txt h4.red{color:#f30}.msg_txt p{line-height:22px}'; 
    $str .= '</style>'; 
    $str .= '</head>'; 
    $str .= '<body>'; 
    $str .= '<div class="message">'; 
    $str .= '<h3>'.$msgTitle.'</h3>'; 
    $str .= '<div class="msg_txt">'; 
    $str .= '<h4 class="red">'.$message.'</h4>'; 
    $str .= '<p>系统将在 <span style="color:blue;font-weight:bold">3</span> 秒后自动跳转,如果不想等待,直接点击 <a href="{$jumpUrl}">这里</a> 跳转</p>'; 
    $str .= "<script>setTimeout('location.replace('".$jumpUrl."')',2000)</script>"; 
    $str .= '</div>'; 
    $str .= '</div>'; 
    $str .= '</body>'; 
    $str .= '</html>'; 
    echo $str; 
}


/**
 * 二维数组排序方法,数字的倒叙排列
 * @param arr
 * @param field
 */
function sortArrByField(&$array, $field, $desc = false){
    $fieldArr = array();
    foreach ($array as $k => $v) {
        $fieldArr[$k] = $v[$field];
    }
    $sort = $desc == false ? SORT_ASC : SORT_DESC;
    array_multisort($fieldArr, $sort, $array);
  
    return $array;
}


/**
 * 递归调用数组值并用其执行指定函数
 * @param  [type] $function [执行的方法]
 * @param  [type] $value    [数组]
 * @return [type]           [description]
 */
function function_deep($function,$value) {
 
    try {
        if(!function_exists($function)){
            $error = '"'.$function.'" is undefined';
            throw new Exception($error);
        }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        die();
    }
 
    if ( is_array($value) ) {
        $fun = Array();
        for($i=1;$i<=count($value);$i++){
            $fun[] = $function; 
        }
        $value = array_map("function_deep",$fun, $value);
    } elseif ( is_object($value) ) {
        $vars = get_object_vars( $value );
        foreach ($vars as $key=>$data) {
            $value->{$key} = function_deep($function,$data );
        }
    } elseif ( is_string( $value ) ) {
        $value = call_user_func($function,$value);
    }
 
    return $value;
}




/**
 * @desc 获取快递信息 
 * @param string $code 快递公司编码
 * @param string $invoice 快递单号
 * @return mixed $result(
      'status','info','state','data'
   )
 */
function getExpressDelivery($code,$invoice){
    $result = array('status'=>0,'info'=>'未知错误');
    $url = "http://m.kuaidi100.com/query?type={$code}&postid={$invoice}&id=1&valicode=&temp=".rand(1,710);
    $body = file_get_contents($url); //FIXME
    $body = json_decode($body,true);
    $result['status'] = $body['status'] == 200 ? 1 : 0;
    $result['info'] = $body['message'];
    $result['data'] = $body['data'];
    isset($body['data']) && ($result['state']=$body['state']) && ($result['data'] = $body['data']) ;
    return $result;
}


/*
 * 经典的概率算法，抽奖
 * $proArr是一个预先设置的数组，
 * 假设数组为：array(100,200,300，400)，
 * 开始是从1,1000 这个概率范围内筛选第一个数是否在他的出现概率范围之内， 
 * 如果不在，则将概率空间，也就是k的值减去刚刚的那个数字的概率空间，
 * 在本例当中就是减去100，也就是说第二个数是在1，900这个范围内筛选的。
 * 这样 筛选到最终，总会有一个数满足要求。
 * 就相当于去一个箱子里摸东西，
 * 第一个不是，第二个不是，第三个还不是，那最后一个一定是。
 * 这个算法简单，而且效率非常高，
 * 这个算法在大数据量的项目中效率非常棒。
 */
function get_rand($proArr) { 
    $result = '';  
    //概率数组的总概率精度 
    $proSum = array_sum($proArr);  
    //概率数组循环 
    foreach ($proArr as $key => $proCur) { 
        $randNum = mt_rand(1, $proSum); 
        if ($randNum <= $proCur) { 
            $result = $key; 
            break; 
        } else { 
            $proSum -= $proCur; 
        }       
    } 
    unset ($proArr);  
    return $result; 
} 


/**
 * 计算距离某个时间点时长
 * @param  [type] $seconds [description]
 * @return [type]          [description]
 */
function changeTimeType($seconds) { 
    if ($seconds > 3600) { 
        $hours = intval($seconds / 3600); 
        $minutes = $seconds % 3600; 
        $time = $hours . ":" . gmstrftime('%M:%S', $minutes); 
    } else { 
        $time = gmstrftime('%H:%M:%S', $seconds); 
    } 
    return $time; 
}




/**
 * 格式化时间
 * @param  [type] $time [要格式化的时间戳]
 * @return [type]       [description]
 */
function time_format ($time) {
    //当前时间
    $now = time();
    //今天零时零分零秒
    $today = strtotime(date('y-m-d', $now));
    //传递时间与当前时秒相差的秒数
    $diff = $now - $time;
    $str = '';
    switch ($time) {
        case $diff < 60 :
            $str = $diff . '秒前';
            break;
        case $diff < 3600 :
            $str = floor($diff / 60) . '分钟前';
            break;
        case $diff < (3600 * 24) :
            $str = floor($diff / 3600) . '小时前';
            break;
        case $time > $today :
            $str = '今天&nbsp;&nbsp;' . date('H:i', $time);
            break;
        default : 
            $str = date('Y-m-d H:i:s', $time);
    }
    return $str;
} 


/**
 * 传入时间戳,计算距离现在的时间
 * @param  number $time 时间戳
 * @return string     返回多少以前
 */
function word_time($time) {
    $time = (int) substr($time, 0, 10);
    $int = time() - $time;
    $str = '';
    if ($int <= 2){
        $str = sprintf('刚刚', $int);
    }elseif ($int < 60){
        $str = sprintf('%d秒前', $int);
    }elseif ($int < 3600){
        $str = sprintf('%d分钟前', floor($int / 60));
    }elseif ($int < 86400){
        $str = sprintf('%d小时前', floor($int / 3600));
    }elseif ($int < 1728000){
        $str = sprintf('%d天前', floor($int / 86400));
    }else{
        $str = date('Y-m-d H:i:s', $time);
    }
    return $str;
}


/**
 * 替换微博内容的URL地址、@用户与表情
 * @param  [String] $content [需要处理的微博字符串]
 * @return [String]          [处理完成后的字符串]
 */
function replace_weibo ($content) {
    if (empty($content)) return;

    //给URL地址加上 <a> 链接
    $preg = '/(?:http:\/\/)?([\w.]+[\w\/]*\.[\w.]+[\w\/]*\??[\w=\&\+\%]*)/is';
    $content = preg_replace($preg, '<a href="http://\\1" target="_blank">\\1</a>', $content);
    
    //给@用户加是 <a> 链接
    //$preg = '/@(\S+)\s/is';
    $preg = '/@([^\s|\/|:|@]+)/';
    $content = preg_replace($preg, '<a href="/user/\\1">@\\1</a>', $content);
    
    //提取微博内容中所有表情文件
    $preg = '/\[(\S+?)\]/is';
    preg_match_all($preg, $content, $arr);
    //载入表情包数组文件
    $phiz = include './Data/phiz.php';
    if (!empty($arr[1])) {
        foreach ($arr[1] as $k => $v) {
            $name = array_search($v, $phiz);
            if ($name) {
                $content = str_replace($arr[0][$k], '<img src="/static/Images/phiz/'.$name.'.gif" title="' . $v . '"/>', $content);
            }
        }
    }
    return  str_replace(config('filter'),'***',$content);
}






/**
 * 往内存写入推送信息
 * @param [type] $id   [用户id]
 * @param [type] $type [1.评论，2.私信，3.@用户]
 * @param [type] $flush [是否清零]
 */
 function set_msg($uid,$type,$flush=false)
{
    $name = '';
    switch ($type) {
        case 1:
            $name = 'comment';
            break;
        case 2:
            $name = 'letter';
            break;
        case 3:
            $name = 'atme';
            break;
    }
    //清零处理
    if($flush){
        $data = cache('usermsg'.$uid);
        $data['$name']['total'] = 0;//总条数清零
        $data['$name']['status'] = 0;//修改状态1.没有推送，0.已推送过
        cache('usermsg'.$uid,$data,0);//重新写入缓存
        return;
    }
    //判断缓存是否存在
    if(cache('usermsg'.$uid)){//存在，修改相应数据
        $data = cache('usermsg'.$uid);
        $data[$name]['total']++;//总条数加1
        $data[$name]['status'] = 1;//修改状态1.没有推送，0.已推送过
        cache('usermsg'.$uid,$data,0);//重新写入缓存
    }else{//缓存不存在，初始化用户数据，写入内存
        $data = array(
            'comment'=>array('total'=>0,'status'=>0),
            'letter'=>array('total'=>0,'status'=>0),
            'atme'=>array('total'=>0,'status'=>0),
        );
        $data[$name]['total']++;//总条数加1
        $data[$name]['status'] = 1;//修改状态1.没有推送，0.已推送过
        cache('usermsg'.$uid,$data,0);//重新写入缓存
    }
}


//传递数据以易于阅读的样式格式化后输出
function p($data){
    // 定义样式
    $str='<pre style="display: block;padding: 9.5px;margin: 44px 0 0 0;font-size: 13px;line-height: 1.42857;color: #333;word-break: break-all;word-wrap: break-word;background-color: #F5F5F5;border: 1px solid #CCC;border-radius: 4px;">';
    // 如果是boolean或者null直接显示文字；否则print
    if (is_bool($data)) {
        $show_data=$data ? 'true' : 'false';
    }elseif (is_null($data)) {
        $show_data='null';
    }else{
        $show_data=print_r($data,true);
    }
    $str.=$show_data;
    $str.='</pre>';
    echo $str;
}


    /**
     * 图像上传处理
     * @param [String] $path     [保存文件夹名称]
     * @param [String] $width     [缩略图宽度]
     * @param [String] $height     [缩略图高度]
     * @return [Array] [图片上传信息]
     */
function _upload($path, $width, $height) {
        // 文件上传
        $config = array(
            'maxSize'    => C('UPLOAD_MAX_SIZE'),            // 设置附件上传大小
            'exts'        => C('UPLOAD_EXTS'),                // 设置附件上传类型    
            'rootPath'    => C('UPLOAD_PATH') . $path . '/',     // 设置附件上传目录
            'replace'    => true,                    // 覆盖同名文件
            'saveName'    => array('uniqid',''),        // 文件名创建规则
            'autoSub'    => true,                    // 自动使用子目录保存上传文件
            'subName'    => array('date','Ymd'),        // 子目录创建规则
        );
        $upload = new \Think\Upload($config);        // 实例化上传类
        $info = $upload->upload();
        if (!$info) {
            return array('status' => 0, 'msg' => $upload->getError());
        } else {
            // 生成缩略图
            foreach ($info as $file) {
                // 获取原图地址
                $img = $config['rootPath'] . $file['savepath'] . $file['savename'];
                $image = new \Think\Image();            // GD库
                $image->open($img);                     // 打开原图
                $thumbWidth  = explode(',', $width);    // 获取宽度
                $thumbHeight = explode(',', $height);    // 获取高度
                // 设置缩略图宽、高、前缀
                for($i=0;$i<count($thumbWidth);$i++)
                {
                    $thumb[$i]=array('w'=> $thumbWidth[$i], 'h' => $thumbHeight[$i], 'n' => $thumbWidth[$i].'_'.$thumbHeight[$i].'_' );
                    $bpath[$i]=$file['savepath'].$thumbWidth[$i].'_'.$thumbHeight[$i].'_'.$file['savename'];
                }
                foreach ($thumb as $value){
                    // 生成缩略图保存路径,并命名
                    $save_path = $config['rootPath'] . $file['savepath'] . $value['n'] . $file['savename'];
                    // 设置宽高和缩略类型,并保存缩略图
                    $image->thumb($value['w'], $value['h'], \Think\Image::IMAGE_THUMB_FIXED)->save($save_path);
                }
                unlink($img);        //上传生成缩略图以后删除源文件
                return array(
                    'status' => 1,
                    'savepath' =>$bpath
                );
            }
        }
    }

/**
 * app 图片上传
 * @return string 上传后的图片名
 */
function app_upload_image($path,$maxSize=52428800){
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path=trim($path,'.');
    $path=trim($path,'/');
    $config=array(
        'rootPath'  =>'./',         //文件上传保存的根路径
        'savePath'  =>'./'.$path.'/',   
        'exts'      => array('jpg', 'gif', 'png', 'jpeg','bmp'),
        'maxSize'   => $maxSize,
        'autoSub'   => true,
        );
    $upload = new \Think\Upload($config);// 实例化上传类
    $info = $upload->upload();
    if($info) {
        foreach ($info as $k => $v) {
            $data[]=trim($v['savepath'],'.').$v['savename'];
        }
        return $data;
    }
}

/**
 * 实例化阿里云oos
 * @return object 实例化得到的对象
 */
function new_oss(){
    vendor('Alioss.autoload');
    $config=C('ALIOSS_CONFIG');
    $oss=new \OSS\OssClient($config['KEY_ID'],$config['KEY_SECRET'],$config['END_POINT']);
    return $oss;
}

/**
 * 上传文件到oss并删除本地文件
 * @param  string $path 文件路径
 * @return bollear      是否上传
 */
function oss_upload($path){
    // 获取bucket名称
    $bucket=C('ALIOSS_CONFIG.BUCKET');
    // 先统一去除左侧的.或者/ 再添加./
    $oss_path=ltrim($path,'./');
    $path='./'.$oss_path;
    if (file_exists($path)) {
        // 实例化oss类
        $oss=new_oss();
        // 上传到oss    
        $oss->uploadFile($bucket,$oss_path,$path);
        // 如需上传到oss后 自动删除本地的文件 则删除下面的注释 
        // unlink($path);
        return true;
    }
    return false;
}

/**
 * 删除oss上指定文件
 * @param  string $object 文件路径 例如删除 /Public/README.md文件  传Public/README.md 即可
 */
function oss_delet_object($object){
    // 实例化oss类
    $oss=new_oss();
    // 获取bucket名称
    $bucket=C('ALIOSS_CONFIG.BUCKET');
    $test=$oss->deleteObject($bucket,$object);
}

/**
 * app 视频上传
 * @return string 上传后的视频名
 */
function app_upload_video($path,$maxSize=52428800){
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path=trim($path,'.');
    $path=trim($path,'/');
    $config=array(
        'rootPath'  =>'./',         //文件上传保存的根路径
        'savePath'  =>'./'.$path.'/',   
        'exts'      => array('mp4','avi','3gp','rmvb','gif','wmv','mkv','mpg','vob','mov','flv','swf','mp3','ape','wma','aac','mmf','amr','m4a','m4r','ogg','wav','wavpack'),
        'maxSize'   => $maxSize,
        'autoSub'   => true,
        );
    $upload = new \Think\Upload($config);// 实例化上传类
    $info = $upload->upload();
    if($info) {
        foreach ($info as $k => $v) {
            $data[]=trim($v['savepath'],'.').$v['savename'];
        }
        return $data;
    }
}


/**
 * 返回文件格式
 * @param  string $str 文件名
 * @return string      文件格式
 */
function file_format($str){
    // 取文件后缀名
    $str=strtolower(pathinfo($str, PATHINFO_EXTENSION));
    // 图片格式
    $image=array('webp','jpg','png','ico','bmp','gif','tif','pcx','tga','bmp','pxc','tiff','jpeg','exif','fpx','svg','psd','cdr','pcd','dxf','ufo','eps','ai','hdri');
    // 视频格式
    $video=array('mp4','avi','3gp','rmvb','gif','wmv','mkv','mpg','vob','mov','flv','swf','mp3','ape','wma','aac','mmf','amr','m4a','m4r','ogg','wav','wavpack');
    // 压缩格式
    $zip=array('rar','zip','tar','cab','uue','jar','iso','z','7-zip','ace','lzh','arj','gzip','bz2','tz');
    // 文档格式
    $text=array('exe','doc','ppt','xls','wps','txt','lrc','wfs','torrent','html','htm','java','js','css','less','php','pdf','pps','host','box','docx','word','perfect','dot','dsf','efe','ini','json','lnk','log','msi','ost','pcs','tmp','xlsb');
    // 匹配不同的结果
    switch ($str) {
        case in_array($str, $image):
            return 'image';
            break;
        case in_array($str, $video):
            return 'video';
            break;
        case in_array($str, $zip):
            return 'zip';
            break;
        case in_array($str, $text):
            return 'text';
            break;
        default:
            return 'image';
            break;
    }
}
 
/**
 * 发送友盟推送消息
 * @param  integer  $uid   用户id
 * @param  string   $title 推送的标题
 * @return boolear         是否成功
 */
function umeng_push($uid,$title){
    // 获取token
    $device_tokens=D('OauthUser')->getToken($uid,2);
    // 如果没有token说明移动端没有登录；则不发送通知
    if (empty($device_tokens)) {
        return false;
    }
    // 导入友盟
    Vendor('Umeng.Umeng');
    // 自定义字段   根据实际环境分配；如果不用可以忽略
    $status=1;
    // 消息未读总数统计  根据实际环境获取未读的消息总数 此数量会显示在app图标右上角
    $count_number=1;
    $data=array(
        'key'=>'status',
        'value'=>"$status",
        'count_number'=>$count_number
        );
    // 判断device_token  64位表示为苹果 否则为安卓
    if(strlen($device_tokens)==64){
        $key=C('UMENG_IOS_APP_KEY');
        $timestamp=C('UMENG_IOS_SECRET');
        $umeng=new \Umeng($key, $timestamp);
        $umeng->sendIOSUnicast($data,$title,$device_tokens);
    }else{
        $key=C('UMENG_ANDROID_APP_KEY');
        $timestamp=C('UMENG_ANDROID_SECRET');
        $umeng=new \Umeng($key, $timestamp);
        $umeng->sendAndroidUnicast($data,$title,$device_tokens);
    }
    return true;
}
 

/**
 * 获取完整网络连接
 * @param  string $path 文件路径
 * @return string       http连接
 */
function get_url($path){
    // 如果是空；返回空
    if (empty($path)) {
        return '';
    }
    // 如果已经有http直接返回
    if (strpos($path, 'http://')!==false) {
        return $path;
    }
    // 判断是否使用了oss
    $alioss=C('ALIOSS_CONFIG');
    if (empty($alioss['KEY_ID'])) {
        return 'http://'.$_SERVER['HTTP_HOST'].$path;
    }else{
        return 'http://'.$alioss['BUCKET'].'.'.$alioss['END_POINT'].$path;
    }
    
}



/**
 * 根据配置项获取对应的key和secret
 * @return array key和secret
 */
function get_rong_key_secret(){
    // 判断是需要开发环境还是生产环境的key
    if (C('RONG_IS_DEV')) {
        $key=C('RONG_DEV_APP_KEY');
        $secret=C('RONG_DEV_APP_SECRET');
    }else{
        $key=C('RONG_PRO_APP_KEY');
        $secret=C('RONG_PRO_APP_SECRET');
    }
    $data=array(
        'key'=>$key,
        'secret'=>$secret
        );
    return $data;
}

/**
 * 获取融云token
 * @param  integer $uid 用户id
 * @return integer      token
 */
function get_rongcloud_token($uid){
    // 从数据库中获取token
    $token=D('OauthUser')->getToken($uid,1);
    // 如果有token就返回
    if ($token) {
        return $token;
    }
    // 获取用户昵称和头像
    $user_data=M('Users')->field('username,avatar')->getById($uid);
    // 用户不存在
    if (empty($user_data)) {
        return false;
    }
    // 获取头像url格式
    $avatar=get_url($user_data['avatar']);
    // 获取key和secret
    $key_secret=get_rong_key_secret();
    // 实例化融云
    $rong_cloud=new \Org\Xb\RongCloud($key_secret['key'],$key_secret['secret']);
    // 获取token
    $token_json=$rong_cloud->getToken($uid,$user_data['username'],$avatar);
    $token_array=json_decode($token_json,true);
    // 获取token失败
    if ($token_array['code']!=200) {
        return false;
    }
    $token=$token_array['token'];
    $data=array(
        'uid'=>$uid,
        'type'=>1,
        'nickname'=>$user_data['username'],
        'head_img'=>$avatar,
        'access_token'=>$token
        );
    // 插入数据库
    $result=D('OauthUser')->addData($data);
    if ($result) {
        return $token;
    }else{
        return false;
    }
}

/**
 * 更新融云头像
 * @param  integer $uid 用户id
 * @return boolear      操作是否成功
 */
function refresh_rongcloud_token($uid){
    // 获取用户昵称和头像
    $user_data=M('Users')->field('username,avatar')->getById($uid);
    // 用户不存在
    if (empty($user_data)) {
        return false;
    }
    $avatar=get_url($user_data['avatar']);
    // 获取key和secret
    $key_secret=get_rong_key_secret();
    // 实例化融云
    $rong_cloud=new \Org\Xb\RongCloud($key_secret['key'],$key_secret['secret']);
    // 更新融云用户头像
    $result_json=$rong_cloud->userRefresh($uid,$user_data['username'],$avatar);
    $result_array=json_decode($result_json,true);
    if ($result_array['code']==200) {
        return true;
    }else{
        return false;
    }
}

/**
 * 删除指定的标签和内容
 * @param array $tags 需要删除的标签数组
 * @param string $str 数据源
 * @param string $content 是否删除标签内的内容 0保留内容 1不保留内容
 * @return string
 */
function strip_html_tags($tags,$str,$content=0){
    if($content){
        $html=array();
        foreach ($tags as $tag) {
            $html[]='/(<'.$tag.'.*?>[\s|\S]*?<\/'.$tag.'>)/';
        }
        $data=preg_replace($html,'',$str);
    }else{
        $html=array();
        foreach ($tags as $tag) {
            $html[]="/(<(?:\/".$tag."|".$tag.")[^>]*>)/i";
        }
        $data=preg_replace($html, '', $str);
    }
    return $data;
}

/**
 * 传递ueditor生成的内容获取其中图片的路径
 * @param  string $str 含有图片链接的字符串
 * @return array       匹配的图片数组
 */
function get_ueditor_image_path($str){
    //$preg='/\/ueditor\/php\/upload\/image\/u(m)?editor\/\d*\/\d*\.[jpg|jpeg|png|bmp]*/i';
    $preg='/\<img.*?src\=\"(.*?)\"[^>]*>/i';

//$preg='/<li class\=\"list_item\">(.*?)<\/li>/i';
    preg_match_all($preg, $str,$data);
    return current($data);
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
function re_substr($str, $start=0, $length, $suffix=true, $charset="utf-8") {
    if(function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        $slice = iconv_substr($str,$start,$length,$charset);
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']  = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    $omit=mb_strlen($str) >=$length ? '...' : '';
    return $suffix ? $slice.$omit : $slice;
}



/**
 * 取得根域名
 * @param type $domain 域名
 * @return string 返回根域名
 */
function get_url_to_domain($domain) {
    $re_domain = '';
    $domain_postfix_cn_array = array("com", "net", "org", "gov", "edu", "com.cn", "cn");
    $array_domain = explode(".", $domain);
    $array_num = count($array_domain) - 1;
    if ($array_domain[$array_num] == 'cn') {
        if (in_array($array_domain[$array_num - 1], $domain_postfix_cn_array)) {
            $re_domain = $array_domain[$array_num - 2] . "." . $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
        } else {
            $re_domain = $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
        }
    } else {
        $re_domain = $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
    }
    return $re_domain;
}


/**
 * 获取当前站点的访问路径根目录
 * @return [type] [description]
 */
function getSiteUrl() {
 $uri = $_SERVER['REQUEST_URI']?$_SERVER['REQUEST_URI']:($_SERVER['PHP_SELF']?$_SERVER['PHP_SELF']:$_SERVER['SCRIPT_NAME']);
 return 'http://'.$_SERVER['HTTP_HOST'].substr($uri, 0, strrpos($uri, '/')+1);
}


/**
 * 数字转人民币,超过亿会报错，请用类
 * @param [type] $num [description]
 * @return [type]  [description]
 */
function numtormb ($num) {
    $c1 = "零壹贰叁肆伍陆柒捌玖";
    $c2 = "分角元拾佰仟万拾佰仟亿";
    $num = round($num, 2);
    $num = $num * 100;
    if (strlen($num) > 10) {
        return "oh,sorry,the number is too long!";
    }
    $i = 0;
    $c = "";
    while(1){
        if ($i == 0) {
            $n = substr($num, strlen($num)-1, 1);
        }else{
            $n = $num % 10;
        }
        $p1 = substr($c1, 3 * $n, 3);
        $p2 = substr($c2, 3 * $i, 3);
        if($n != '0' || ($n == '0' && ($p2 == '亿' || $p2 == '万' || $p2 == '元'))) {
            $c = $p1 . $p2 . $c;
        }else{
            $c = $p1 . $c;
        }
        $i = $i + 1;
        $num = $num / 10;
        $num = (int)$num;
        if($num == 0){
            break;
        }
    }
    $j = 0;
    $slen = strlen($c);
    while($j < $slen){
        $m = substr($c, $j, 6);
        if ($m == '零元' || $m == '零万' || $m == '零亿' || $m == '零零') {
            $left = substr($c, 0, $j);
            $right = substr($c, $j + 3);
            $c = $left . $right;
            $j = $j-3;
            $slen = $slen-3;
        }
        $j = $j + 3;
    }
    if (substr($c, strlen($c)-3, 3) == '零') {
        $c = substr($c, 0, strlen($c)-3);
    } // if there is a '0' on the end , chop it out
    return $c . "整";
}


/**
 * 找零钱方案
 * @param  [type] $m [description]
 * @param  [type] $n [description]
 * @return [type]    [description]
 */
function zhaoqian($m,$n)
{

    $k=count($m);
    for($i=0;$i<$k;$i++)
    {
        $num[$i]['con']=$m[$i].'面值';
        $num[$i]['num']=(int)($n/$m[$i]);
        $n=$n%$m[$i];  
    } 
    return  $num; 
}





/**
 * 检查是否是身份证号
 * @param  [type]  $number [description]
 * @return boolean         [description]
 */
function isIdCard($number) { // 检查是否是身份证号
    //$number = getIDCard($number);
    // 转化为大写，如出现x
    $number = strtoupper($number);
    //加权因子
    $wi = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
    //校验码串
    $ai = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
    //按顺序循环处理前17位
    $sigma = 0;
    for ($i = 0;$i < 17;$i++) {
        //提取前17位的其中一位，并将变量类型转为实数
        $b = (int) $number{$i};

        //提取相应的加权因子
        $w = $wi[$i];

        //把从身份证号码中提取的一位数字和加权因子相乘，并累加
        $sigma += $b * $w;
    }
    //计算序号
    $snumber = $sigma % 11;

    //按照序号从校验码串中提取相应的字符。
    $check_number = $ai[$snumber];

    if ($number{17} == $check_number) {
        return true;
    } else {
        return false;
    }
}





/**
 * 按符号截取字符串的指定部分
 * @param string $str 需要截取的字符串
 * @param string $sign 需要截取的符号
 * @param int $number 如是正数以0为起点从左向右截  负数则从右向左截
 * @return string 返回截取的内容
 */
/*  示例
    $str='123/456/789';
    cut_str($str,'/',0);  返回 123
    cut_str($str,'/',-1);  返回 789
    cut_str($str,'/',-2);  返回 456
    具体参考 http://www.baijunyao.com/index.php/Home/Index/article/aid/18
*/
function cut_str($str,$sign,$number){
    $array=explode($sign, $str);
    $length=count($array);
    if($number<0){
        $new_array=array_reverse($array);
        $abs_number=abs($number);
        if($abs_number>$length){
            return 'error';
        }else{
            return $new_array[$abs_number-1];
        }
    }else{
        if($number>=$length){
            return 'error';
        }else{
            return $array[$number];
        }
    }
}



/**
 * 根据开始字符串和结束字符串截取需要的采集内容数据
 * @param  [type]  &$str      [需要采集的字符串]
 * @param  [type]  $findStart [开始位置]
 * @param  boolean $findEnd   [结束为止]
 * @param  string  $encoding  [编码]
 * @return [type]             [description]
 * $str = '1234567890';
 * var_dump(strCutByStr($str, '2', '9'));//输出 345678
 * var_dump(strCutByStr($str, array('a', '4'), array('b', '7')));//输出 56，因为第一组匹配没有找到，就执行第二组，以此类推
 * 如果要采集网页，需要将网页转换成html格式然后保存为变量！
 */
function strCutByStr(&$str, $findStart, $findEnd = false, $encoding = 'utf-8'){
    if(is_array($findStart)){
        if(count($findStart) === count($findEnd)){
            foreach($findStart as $k => $v){
                if(($result = strCutByStr($str, $v, $findEnd[$k], $encoding)) !== false){
                    return $result;
                }
            }
            return false;
        }else{
            return false;
        }
    }
     
    if(($start = mb_strpos($str, $findStart, 0, $encoding)) === false){
        return false;
    }
     
    $start += mb_strlen($findStart, $encoding);
     
    if($findEnd === false){
        return mb_substr($str, $start, NULL, $encoding);
    }
     
    if(($length = mb_strpos($str, $findEnd, $start, $encoding)) === false){
        return false;
    }
     
    return mb_substr($str, $start, $length - $start, $encoding);
}

/**
 * 无极限分类
 * @param  [type]  &$list [循环数据]
 * @param  integer $pid   [父级id]
 * @param  integer $level [级别]
 * @param  string  $html  [前缀]
 * @return [type]         [description]
 */
function tree(&$list,$pid=0,$level=0,$html='--'){
    static $tree = array();
    foreach($list as $v){
        if($v['pid'] == $pid){
            $v['level'] = $level;
             $v['html'] = str_repeat($html,$level);
            $tree[] = $v;
            tree($list,$v['id'],$level+1);
        } 
    }
    return $tree;
}


 
/**
 * 将数据格式化成树形结构
 * @author Xuefen.Tong
 * @param array $items
 * @return array 
 */
function genTree($items) {
    $tree = array(); //格式化好的树
    foreach ($items as $item)
        if (isset($items[$item['pid']]))
            $items[$item['pid']]['son'][] = &$items[$item['id']];
        else
            $tree[] = &$items[$item['id']];
    return $tree;
}



/**
 * 获取一定范围内的随机数字
 * 跟rand()函数的区别是 位数不足补零 例如
 * rand(1,9999)可能会得到 465
 * rand_number(1,9999)可能会得到 0465  保证是4位的
 * @param integer $min 最小值
 * @param integer $max 最大值
 * @return string
 */
function rand_number ($min=1, $max=9999) {
    return sprintf("%0".strlen($max)."d", mt_rand($min,$max));
}

/**
 * 生成一定数量的随机数，并且不重复
 * @param integer $number 数量
 * @param string $len 长度
 * @param string $type 字串类型
 * 0 小写字母 1大写字母 2 数字 3大小写 4小写与数字 5大写与数字     其它 混合
 * @return string
 */
function build_count_rand ($number,$length=4,$mode=1) {
    if($mode==1 && $length<strlen($number) ) {
        //不足以生成一定数量的不重复数字
        return false;
    }
    $rand   =  array();
    for($i=0; $i<$number; $i++) {
        $rand[] = rand_string($length,$mode);
    }
    $unqiue = array_unique($rand);
    if(count($unqiue)==count($rand)) {
        return $rand;
    }
    $count   = count($rand)-count($unqiue);
    for($i=0; $i<$count*3; $i++) {
        $rand[] = rand_string($length,$mode);
    }
    $rand = array_slice(array_unique ($rand),0,$number);
    return $rand;
}

/**
 * 随机生成一定长度的字符串
 * @param  [type] $length [长度]
 * @param  [type] $model  [类别]
 * @return [type]         [description]
 *  0 小写字母 1大写字母 2 数字 3大小写 4小写与数字 5大写与数字     其它 混合
 */
function rand_string($length,$model=0){
	if($model == 0){
		$str = "abcdefghijklmnopqrstuvwxyz";
	}elseif($model == 1){
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	}elseif($model == 2){
		$str = "0123456789";
	}elseif($model == 3){
		$str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	}elseif($model == 4){
		$str = "0123456789abcdefghijklmnopqrstuvwxyz";
	}elseif($model == 5){
		$str = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	}else{
		$str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	}
	$res = '';
	for($i=0;$i<$length;$i++){
		$res .=$str[mt_rand(0,strlen($str)-1)];
	}
	return $res;
}



/**
 * 生成不重复的随机数
 * @param  int $start  需要生成的数字开始范围
 * @param  int $end 结束范围
 * @param  int $length 需要生成的随机数个数
 * @return array       生成的随机数
 */
function get_rand_number($start=1,$end=10,$length=4){
    $connt=0;
    $temp=array();
    while($connt<$length){
        $temp[]=rand($start,$end);
        $data=array_unique($temp);
        $connt=count($data);
    }
    sort($data);
    return $data;
}



/**
 * 将路径转换加密
 * @param  string $file_path 路径
 * @return string            转换后的路径
 */
function path_encode($file_path){
    return rawurlencode(base64_encode($file_path));
}

/**
 * 将路径解密
 * @param  string $file_path 加密后的字符串
 * @return string            解密后的路径
 */
function path_decode($file_path){
    return base64_decode(rawurldecode($file_path));
}



// /**
//  * 使用curl获取远程数据
//  * @param  string $url url连接
//  * @return string      获取到的数据
//  */
// function curl_get_contents($url){
//     $ch=curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);                //设置访问的url地址
//     // curl_setopt($ch,CURLOPT_HEADER,1);               //是否显示头部信息
//     curl_setopt($ch, CURLOPT_TIMEOUT, 5);               //设置超时
//     curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);   //用户访问代理 User-Agent
//     curl_setopt($ch, CURLOPT_REFERER,$_SERVER['HTTP_HOST']);        //设置 referer
//     curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);          //跟踪301
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        //返回结果
//     $r=curl_exec($ch);
//     curl_close($ch);
//     return $r;
// }











/**
 * 处理post上传的文件；并返回路径
 * @param  string $path    字符串 保存文件路径示例： /Upload/image/
 * @param  string $format  文件格式限制
 * @param  string $maxSize 允许的上传文件最大值 52428800
 * @return array           返回ajax的json格式数据
 */
function post_upload($path='file',$format='empty',$maxSize='52428800'){
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path=trim($path,'/');
    // 添加Upload根目录
    $path=strtolower(substr($path, 0,6))==='upload' ? ucfirst($path) : 'Upload/'.$path;
    // 上传文件类型控制
    $ext_arr= array(
            'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
            'photo' => array('jpg', 'jpeg', 'png'),
            'flash' => array('swf', 'flv'),
            'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
            'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2','pdf')
        );
    if(!empty($_FILES)){
        // 上传文件配置
        $config=array(
                'maxSize'   =>  $maxSize,       //   上传文件最大为50M
                'rootPath'  =>  './',           //文件上传保存的根路径
                'savePath'  =>  './'.$path.'/',         //文件上传的保存路径（相对于根路径）
                'saveName'  =>  array('uniqid',''),     //上传文件的保存规则，支持数组和字符串方式定义
                'autoSub'   =>  true,                   //  自动使用子目录保存上传文件 默认为true
                'exts'    =>    isset($ext_arr[$format])?$ext_arr[$format]:'',
            );
        // 实例化上传
        $upload=new \Think\Upload($config);
        // 调用上传方法
        $info=$upload->upload();
        $data=array();
        if(!$info){
            // 返回错误信息
            $error=$upload->getError();
            $data['error_info']=$error;
            return $data;
        }else{
            // 返回成功信息
            foreach($info as $file){
                $data['name']=trim($file['savepath'].$file['savename'],'.');
                return $data;
            }               
        }
    }
}

/**
 * 上传文件类型控制   此方法仅限ajax上传使用
 * @param  string   $path    字符串 保存文件路径示例： /Upload/image/
 * @param  string   $format  文件格式限制
 * @param  integer  $maxSize 允许的上传文件最大值 52428800
 * @return booler       返回ajax的json格式数据
 */
function upload($path='file',$format='empty',$maxSize='52428800'){
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path=trim($path,'/');
    // 添加Upload根目录
    $path=strtolower(substr($path, 0,6))==='upload' ? ucfirst($path) : 'Upload/'.$path;
    // 上传文件类型控制
    $ext_arr= array(
            'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
            'photo' => array('jpg', 'jpeg', 'png'),
            'flash' => array('swf', 'flv'),
            'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
            'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2','pdf')
        );
    if(!empty($_FILES)){
        // 上传文件配置
        $config=array(
                'maxSize'   =>  $maxSize,       //   上传文件最大为50M
                'rootPath'  =>  './',           //文件上传保存的根路径
                'savePath'  =>  './'.$path.'/',         //文件上传的保存路径（相对于根路径）
                'saveName'  =>  array('uniqid',''),     //上传文件的保存规则，支持数组和字符串方式定义
                'autoSub'   =>  true,                   //  自动使用子目录保存上传文件 默认为true
                'exts'    =>    isset($ext_arr[$format])?$ext_arr[$format]:'',
            );
        // 实例化上传
        $upload=new \Think\Upload($config);
        // 调用上传方法
        $info=$upload->upload();
        $data=array();
        if(!$info){
            // 返回错误信息
            $error=$upload->getError();
            $data['error_info']=$error;
            echo json_encode($data);
        }else{
            // 返回成功信息
            foreach($info as $file){
                $data['name']=trim($file['savepath'].$file['savename'],'.');
                echo json_encode($data);
            }               
        }
    }
}



/*
* 计算星座的函数 string get_zodiac_sign(string month, string day)
* 输入：月份，日期
* 输出：星座名称或者错误信息
*/

function get_zodiac_sign($month, $day)
{
    // 检查参数有效性
    if ($month < 1 || $month > 12 || $day < 1 || $day > 31)
        return (false);
        // 星座名称以及开始日期
        $signs = array(
        array( "20" => "水瓶座"),
        array( "19" => "双鱼座"),
        array( "21" => "白羊座"),
        array( "20" => "金牛座"),
        array( "21" => "双子座"),
        array( "22" => "巨蟹座"),
        array( "23" => "狮子座"),
        array( "23" => "处女座"),
        array( "23" => "天秤座"),
        array( "24" => "天蝎座"),
        array( "22" => "射手座"),
        array( "22" => "摩羯座")
    );
    list($sign_start, $sign_name) = each($signs[(int)$month-1]);
    if ($day < $sign_start)
    list($sign_start, $sign_name) = each($signs[($month -2 < 0) ? $month = 11: $month -= 2]);
    return $sign_name;
}

/**
 * 发送 容联云通讯 验证码
 * @param  int $phone 手机号
 * @param  int $code  验证码
 * @return boole      是否发送成功
 */
function send_sms_code($phone,$code){
    //请求地址，格式如下，不需要写https://
    $serverIP='app.cloopen.com';
    //请求端口
    $serverPort='8883';
    //REST版本号
    $softVersion='2013-12-26';
    //主帐号
    $accountSid=C('RONGLIAN_ACCOUNT_SID');
    //主帐号Token
    $accountToken=C('RONGLIAN_ACCOUNT_TOKEN');
    //应用Id
    $appId=C('RONGLIAN_APPID');
    //应用Id
    $templateId=C('RONGLIAN_TEMPLATE_ID');
    $rest = new \Org\Xb\Rest($serverIP,$serverPort,$softVersion);
    $rest->setAccount($accountSid,$accountToken);
    $rest->setAppId($appId);
    // 发送模板短信
    $result=$rest->sendTemplateSMS($phone,array($code,5),$templateId);
    if($result==NULL) {
        return false;
    }
    if($result->statusCode!=0) {
        return  false;
    }else{
        return true;
    }
}


/**
 * 根据文件后缀的不同返回不同的结果
 * @param  string $str 需要判断的文件名或者文件的id
 * @return integer     1:图片  2：视频  3：压缩文件  4：文档  5：其他
 */
function file_category($str){
    // 取文件后缀名
    $str=strtolower(pathinfo($str, PATHINFO_EXTENSION));
    // 图片格式
    $images=array('webp','jpg','png','ico','bmp','gif','tif','pcx','tga','bmp','pxc','tiff','jpeg','exif','fpx','svg','psd','cdr','pcd','dxf','ufo','eps','ai','hdri');
    // 视频格式
    $video=array('mp4','avi','3gp','rmvb','gif','wmv','mkv','mpg','vob','mov','flv','swf','mp3','ape','wma','aac','mmf','amr','m4a','m4r','ogg','wav','wavpack');
    // 压缩格式
    $zip=array('rar','zip','tar','cab','uue','jar','iso','z','7-zip','ace','lzh','arj','gzip','bz2','tz');
    // 文档格式
    $document=array('exe','doc','ppt','xls','wps','txt','lrc','wfs','torrent','html','htm','java','js','css','less','php','pdf','pps','host','box','docx','word','perfect','dot','dsf','efe','ini','json','lnk','log','msi','ost','pcs','tmp','xlsb');
    // 匹配不同的结果
    switch ($str) {
        case in_array($str, $images):
            return 1;
            break;
        case in_array($str, $video):
            return 2;
            break;
        case in_array($str, $zip):
            return 3;
            break;
        case in_array($str, $document):
            return 4;
            break;
        default:
            return 5;
            break;
    }
}

/**
 * 组合缩略图
 * @param  string  $file_path  原图path
 * @param  integer $size       比例
 * @return string              缩略图
 */
function get_min_image_path($file_path,$width=170,$height=170){
    $min_path=str_replace('.', '_'.$width.'_'.$height.'.', trim($file_path,'.'));
    $min_path=OSS_URL.$min_path;
    return $min_path;
} 

/**
 * 不区分大小写的in_array()
 * @param  string $str   检测的字符
 * @param  array  $array 数组
 * @return boolear       是否in_array
 */
function in_iarray($str,$array){
    $str=strtolower($str);
    $array=array_map('strtolower', $array);
    if (in_array($str, $array)) {
        return true;
    }
    return false;
}


/**
 * 生成缩略图
 * @param  string  $image_path 原图path
 * @param  integer $width      缩略图的宽
 * @param  integer $height     缩略图的高
 * @return string             缩略图path
 */
function crop_image($image_path,$width=170,$height=170){
    $image_path=trim($image_path,'.');
    $min_path='.'.str_replace('.', '_'.$width.'_'.$height.'.', $image_path);
    $image = new \Think\Image();
    $image->open($image_path);
    // 生成一个居中裁剪为$width*$height的缩略图并保存
    $image->thumb($width, $height,\Think\Image::IMAGE_THUMB_CENTER)->save($min_path);
    oss_upload($min_path);
    return $min_path;
}

/**
 * 上传文件类型控制 此方法仅限ajax上传使用
 * @param  string   $path    字符串 保存文件路径示例： /Upload/image/
 * @param  string   $format  文件格式限制
 * @param  integer  $maxSize 允许的上传文件最大值 52428800
 * @return booler   返回ajax的json格式数据
 */
function ajax_upload($path='file',$format='empty',$maxSize='52428800'){
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path=trim($path,'/');
    // 添加Upload根目录
    $path=strtolower(substr($path, 0,6))==='upload' ? ucfirst($path) : 'Upload/'.$path;
    // 上传文件类型控制
    $ext_arr= array(
            'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
            'photo' => array('jpg', 'jpeg', 'png'),
            'flash' => array('swf', 'flv'),
            'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
            'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2','pdf')
        );
    if(!empty($_FILES)){
        // 上传文件配置
        $config=array(
                'maxSize'   =>  $maxSize,               // 上传文件最大为50M
                'rootPath'  =>  './',                   // 文件上传保存的根路径
                'savePath'  =>  './'.$path.'/',         // 文件上传的保存路径（相对于根路径）
                'saveName'  =>  array('uniqid',''),     // 上传文件的保存规则，支持数组和字符串方式定义
                'autoSub'   =>  true,                   // 自动使用子目录保存上传文件 默认为true
                'exts'      =>    isset($ext_arr[$format])?$ext_arr[$format]:'',
            );
        // p($_FILES);
        // 实例化上传
        $upload=new \Think\Upload($config);
        // 调用上传方法
        $info=$upload->upload();
        // p($info);
        $data=array();
        if(!$info){
            // 返回错误信息
            $error=$upload->getError();
            $data['error_info']=$error;
            echo json_encode($data);
        }else{
            // 返回成功信息
            foreach($info as $file){
                $data['name']=trim($file['savepath'].$file['savename'],'.');
                // p($data);
                echo json_encode($data);
            }               
        }
    }
}

/**
 * 检测webuploader上传是否成功
 * @param  string $file_path post中的字段
 * @return boolear           是否成功
 */
function upload_success($file_path){
    // 为兼容传进来的有数组；先转成json
    $file_path=json_encode($file_path);
    // 如果有undefined说明上传失败
    if (strpos($file_path, 'undefined') !== false) {
        return false;
    }
    // 如果没有.符号说明上传失败
    if (strpos($file_path, '.') === false) {
        return false;
    }
    // 否则上传成功则返回true
    return true;
}



/**
 * 把用户输入的文本转义（主要针对特殊符号和emoji表情）
 */
function emoji_encode($str){
    if(!is_string($str))return $str;
    if(!$str || $str=='undefined')return '';

    $text = json_encode($str); //暴露出unicode
    $text = preg_replace_callback("/(\\\u[ed][0-9a-f]{3})/i",function($str){
        return addslashes($str[0]);
    },$text); //将emoji的unicode留下，其他不动，这里的正则比原答案增加了d，因为我发现我很多emoji实际上是\ud开头的，反而暂时没发现有\ue开头。
    return json_decode($text);
}

/**
 * 检测是否是手机访问
 */
function is_mobile(){
    $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    $useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';
    function _is_mobile($substrs,$text){
        foreach($substrs as $substr)
            if(false!==strpos($text,$substr)){
                return true;
            }
            return false;
    }
    $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
    $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');

    $found_mobile=_is_mobile($mobile_os_list,$useragent_commentsblock) ||
              _is_mobile($mobile_token_list,$useragent);
    if ($found_mobile){
        return true;
    }else{
        return false;
    }
}

/**
 * 将utf-16的emoji表情转为utf8文字形
 * @param  string $str 需要转的字符串
 * @return string      转完成后的字符串
 */
function escape_sequence_decode($str) {
    $regex = '/\\\u([dD][89abAB][\da-fA-F]{2})\\\u([dD][c-fC-F][\da-fA-F]{2})|\\\u([\da-fA-F]{4})/sx';
    return preg_replace_callback($regex, function($matches) {
        if (isset($matches[3])) {
            $cp = hexdec($matches[3]);
        } else {
            $lead = hexdec($matches[1]);
            $trail = hexdec($matches[2]);
            $cp = ($lead << 10) + $trail + 0x10000 - (0xD800 << 10) - 0xDC00;
        }

        if ($cp > 0xD7FF && 0xE000 > $cp) {
            $cp = 0xFFFD;
        }
        if ($cp < 0x80) {
            return chr($cp);
        } else if ($cp < 0xA0) {
            return chr(0xC0 | $cp >> 6).chr(0x80 | $cp & 0x3F);
        }
        $result =  html_entity_decode('&#'.$cp.';');
        return $result;
    }, $str);
}

/**
 * 获取当前访问的设备类型
 * @return integer 1：其他  2：iOS  3：Android
 */
function get_device_type(){
    //全部变成小写字母
    $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    $type = 1;
    //分别进行判断
    if(strpos($agent, 'iphone')!==false || strpos($agent, 'ipad')!==false){
        $type = 2;
    } 
    if(strpos($agent, 'android')!==false){
        $type = 3;
    }
    return $type;
}

/**
 * 生成pdf
 * @param  string $html      需要生成的内容
 */
function pdf($html='<h1 style="color:red">hello word</h1>'){
    vendor('tcpdf.tcpdf');
    $pdf = new \Tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // 设置打印模式
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('TCPDF Example 001');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
    // 是否显示页眉
    $pdf->setPrintHeader(false);
    // 设置页眉显示的内容
    $pdf->SetHeaderData('logo.png', 60, 'baijunyao.com', '白俊遥博客', array(0,64,255), array(0,64,128));
    // 设置页眉字体
    $pdf->setHeaderFont(Array('dejavusans', '', '12'));
    // 页眉距离顶部的距离
    $pdf->SetHeaderMargin('5');
    // 是否显示页脚
    $pdf->setPrintFooter(true);
    // 设置页脚显示的内容
    $pdf->setFooterData(array(0,64,0), array(0,64,128));
    // 设置页脚的字体
    $pdf->setFooterFont(Array('dejavusans', '', '10'));
    // 设置页脚距离底部的距离
    $pdf->SetFooterMargin('10');
    // 设置默认等宽字体
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    // 设置行高
    $pdf->setCellHeightRatio(1);
    // 设置左、上、右的间距
    $pdf->SetMargins('10', '10', '10');
    // 设置是否自动分页  距离底部多少距离时分页
    $pdf->SetAutoPageBreak(TRUE, '15');
    // 设置图像比例因子
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    $pdf->setFontSubsetting(true);
    $pdf->AddPage();
    // 设置字体
    $pdf->SetFont('stsongstdlight', '', 14, '', true);
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    ob_end_clean();
    $pdf->Output('example_001.pdf', 'I');
}


/**
 * 生成二维码
 * @param  string  $url  url连接
 * @param  integer $size 尺寸 纯数字
 */
function qrcode($url,$upload=false,$size=10){
    Vendor('Phpqrcode.phpqrcode');
    QRcode::png($url,$upload,QR_ECLEVEL_L,$size,2,false,0xFFFFFF,0x000000);
}


/**
 * 数组转xls格式的excel文件
 * @param  array  $data      需要生成excel文件的数组
 * @param  string $filename  生成的excel文件名
 *      示例数据：
        $data = array(
            array(NULL, 2010, 2011, 2012),
            array('Q1',   12,   15,   21),
            array('Q2',   56,   73,   86),
            array('Q3',   52,   61,   69),
            array('Q4',   30,   32,    0),
           );
 */
function create_xls($data,$filename='simple.xls'){
    ini_set('max_execution_time', '0');
    Vendor('PHPExcel.PHPExcel');
    $filename=str_replace('.xls', '', $filename).'.xls';
    $phpexcel = new PHPExcel();
    $phpexcel->getProperties()
        ->setCreator("Maarten Balliauw")
        ->setLastModifiedBy("Maarten Balliauw")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");
    $phpexcel->getActiveSheet()->fromArray($data);
    $phpexcel->getActiveSheet()->setTitle('Sheet1');
    $phpexcel->setActiveSheetIndex(0);
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$filename");
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0
    $objwriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
    $objwriter->save('php://output');
    exit;
}



/**
 * ajax数组转xls或者xlsx格式的excel文件
 * @param  array  $data      需要生成excel文件的数组
 * @param  string $filename  生成的excel文件名
 */
function create_xls_ajax($data,$header=null,$filename='simple.xls',$filepath){
    ini_set('max_execution_time', '0');
    Vendor('PHPExcel.PHPExcel');
    // 如果手动设置表头；则放在第一行
    if (!is_null($header)) {
        array_unshift($data, $header);
    }
    //文件后缀
    $type = getExt($filename);
    if ($type=='xlsx') { 
        $type='Excel2007'; 
    }elseif($type=='xls') { 
        $type = 'Excel5'; 
    } 
    $phpexcel = new PHPExcel();
    $phpexcel->getProperties()
        ->setCreator("Maarten Balliauw")
        ->setLastModifiedBy("Maarten Balliauw")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");
    $phpexcel->getActiveSheet()->fromArray($data);
    $phpexcel->getActiveSheet()->setTitle('Sheet1');
    $phpexcel->setActiveSheetIndex(0);
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$filename");
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0
    $objwriter = PHPExcel_IOFactory::createWriter($phpexcel,$type);
    //创建文件夹，保存xls文件，返回路径
    mkdirs($filepath);
    //生成文件路径
    $path = $filepath.$filename;
    //生成文件
    $objwriter->save($filepath.iconv('UTF-8','gb2312',$filename));
    //返回路径
    return trim($path,'.');
    exit;
}


/**
 * 读取csv文件
 * @return [type] [description]
 */
function  doCsv($filename){

	$row = 0;
	$j = 1; 
	$file = $filename; 
	$res = array();
	if (($handle = fopen($file, "r")) !== FALSE) {
		
		 while (($data = fgetcsv($handle, ",")) !== FALSE) {
		 		foreach ($data as $k => &$v)
				{
					//将数据值进行在编码 避免中文乱码问题
					$v = iconv('GBK','UTF-8',$v);
				}
			   $res[] = $data;
			   $j++;
			   $row++; 
		 }
	}
	return $res;
}


/**
 * 遍历获取execl数据
 * @return [type] [description]
 */
function doExcel($filename){
	ini_set('max_execution_time', '0');
	//引入phpexcel类
	vendor("phpexcel.PHPExcel");
	//判断截取文件扩展名
	//$extension = strtolower( pathinfo($filename, PATHINFO_EXTENSION) );
	$extension = getExt($filename);

	//区分上传文件格式
	if($extension == 'xlsx') {
	    $objReader =\PHPExcel_IOFactory::createReader('Excel2007');
	    $objPHPExcel = $objReader->load($filename, $encode = 'utf-8');
	}else if($extension == 'xls'){
	    $objReader =\PHPExcel_IOFactory::createReader('Excel5');
	    $objPHPExcel = $objReader->load($filename, $encode = 'utf-8');
	}

	//获取execl有多少个sheet
	$sheetCount = $objPHPExcel->getSheetCount();
	//循环sheet,读取数据，放入到数组中
	for($i=0;$i<$sheetCount;$i++){
	    $data[$i] = $objPHPExcel->getSheet($i)->toArray();
	}

	//重组数据去除空sheet
	foreach ($data as $k => $v) {
	    //删除头一行
	    //array_shift($data[$k]);
	    //去除空sheet
	    if(!$data[$k]){
	        unset($data[$k]);
	    }
	}

	//去除空数组
	foreach ($data as $k1 => $v1) {
	    foreach ($v1 as $k2 => $v2) {
	        foreach ($v2 as $k3 => $v3) {
	            if(!$v3){
	                unset($data[$k1][$k2]);
	            }
	        }
	    }
	}


	return $data;
}







/**
 * 数据转csv格式的excle
 * @param  array $data      需要转的数组
 * @param  string $header   要生成的excel表头
 * @param  string $filename 生成的excel文件名
 *      示例数组：
        $data = array(
            '1,2,3,4,5',
            '6,7,8,9,0',
            '1,3,5,6,7'
            );
        $header='用户名,密码,头像,性别,手机号';
 */
function create_csv($data,$header=null,$filename='simple.csv'){
    // 如果手动设置表头；则放在第一行
    if (!is_null($header)) {
        array_unshift($data, $header);
    }
    // 防止没有添加文件后缀
    $filename=str_replace('.csv', '', $filename).'.csv';
    ob_clean();
    Header( "Content-type:  application/octet-stream ");
    Header( "Accept-Ranges:  bytes ");
    Header( "Content-Disposition:  attachment;  filename=".$filename);
    foreach( $data as $k => $v){
        // 如果是二维数组；转成一维
        if (is_array($v)) {
            $v=implode(',', $v);
        }
        // 替换掉换行
        $v=preg_replace('/\s*/', '', $v); 
        // 解决导出的数字会显示成科学计数法的问题
        $v=str_replace(',', "\t,", $v); 
        // 转成gbk以兼容office乱码的问题
        echo iconv('UTF-8','gb2312',$v)."\t\r\n";
    }
}



/**
 * ajax下载csv格式的excle
 * @param  array $data      需要转的数组
 * @param  string $header   要生成的excel表头
 * @param  string $filename 生成的excel文件名
 *      示例数组：
        $data = array(
            '1,2,3,4,5',
            '6,7,8,9,0',
            '1,3,5,6,7'
            );
        $header='用户名,密码,头像,性别,手机号';
 */
function create_csv_ajax($data,$header=null,$filename='simple.csv',$filepath){
	ini_set('max_execution_time', '0');
    // 如果手动设置表头；则放在第一行
    if (!is_null($header)) {
        array_unshift($data, $header);
    }
    // 防止没有添加文件后缀
    $filename=str_replace('.csv', '', $filename).'.csv';
    ob_clean();
    Header( "Content-type:  application/octet-stream ");
    Header( "Accept-Ranges:  bytes ");
    Header( "Content-Disposition:  attachment;  filename=".$filename);
    //这里的CSV即你项目的根目录下新建一个CSV文件夹,判断是否存在，不存在则创建
    mkdirs($filepath);
    //文件路径
	$path = ($filepath.iconv('UTF-8','gb2312',$filename));
	$fp = fopen($path, 'w');
    foreach( $data as $k => $v){
    	foreach ($v as $k1 => &$v1)
		{
			//将数据值进行在编码 避免中文乱码问题
			$v1 = iconv('UTF-8','gb2312',$v1);
		}
		fputcsv($fp, $v); 
    }
	fclose($fp);
	return $path;
	exit;
}


/**
 * 判断文件夹是否存在不存在则创建
 * @param  [type]  $dir  [目录]
 * @param  integer $mode [权限]
 * @return [type]        [bool]
 */
function mkdirs($dir, $mode = 0777)
 {
     if (is_dir($dir) || @mkdir($dir, $mode)) return TRUE;
     if (!mkdirs(dirname($dir), $mode)) return FALSE;
     return @mkdir($dir, $mode);
 } 

/**
 * 删除文件
 * @param  [type] $path [description]
 * @return [type]       [description]
 */
function unlinks($path)
{
	return is_file($path) && unlink($path);
}

/**
 * 导入excel文件
 * @param  string $file excel文件路径
 * @return array        excel文件内容数组
 */
// function import_excel($file){
//     // 判断文件是什么格式
//     $type = pathinfo($file); 
//     $type = strtolower($type["extension"]);
//     if ($type=='xlsx') { 
//         $type='Excel2007'; 
//     }elseif($type=='xls') { 
//         $type = 'Excel5'; 
//     } 
//     ini_set('max_execution_time', '0');
//     Vendor('PHPExcel.PHPExcel');
//     // 判断使用哪种格式
//     $objReader = PHPExcel_IOFactory::createReader($type);
//     $objPHPExcel = $objReader->load($file); 
//     $sheet = $objPHPExcel->getSheet(0); 
//     // 取得总行数 
//     $highestRow = $sheet->getHighestRow();     
//     // 取得总列数      
//     $highestColumn = $sheet->getHighestColumn(); 
//     //循环读取excel文件,读取一条,插入一条
//     $data=array();
//     //从第一行开始读取数据
//     for($j=1;$j<=$highestRow;$j++){
//         //从A列读取数据
//         for($k='A';$k<=$highestColumn;$k++){
//             // 读取单元格
//             $cell = $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();
//             // 开始格式化 
//             if(is_object($cell))  $cell= $cell->__toString();
//             $data[$j][] = $cell;
//         } 
//     }  
//     return $data;
// }

/**
 * 跳向支付宝付款
 * @param  array $order 订单数据 必须包含 out_trade_no(订单号)、price(订单金额)、subject(商品名称标题)
 */
function alipay($order){
    vendor('Alipay.AlipaySubmit','','.class.php');
    // 获取配置
    $config=C('ALIPAY_CONFIG');
    $data=array(
        "_input_charset" => $config['input_charset'], // 编码格式
        "logistics_fee" => "0.00", // 物流费用
        "logistics_payment" => "SELLER_PAY", // 物流支付方式SELLER_PAY（卖家承担运费）、BUYER_PAY（买家承担运费）
        "logistics_type" => "EXPRESS", // 物流类型EXPRESS（快递）、POST（平邮）、EMS（EMS）
        "notify_url" => $config['notify_url'], // 异步接收支付状态通知的链接
        "out_trade_no" => $order['out_trade_no'], // 订单号
        "partner" => $config['partner'], // partner 从支付宝商户版个人中心获取
        "payment_type" => "1", // 支付类型对应请求时的 payment_type 参数,原样返回。固定设置为1即可
        "price" => $order['price'], // 订单价格单位为元
        // "price" => 0.01, // // 调价用于测试
        "quantity" => "1", // price、quantity 能代替 total_fee。 即存在 total_fee,就不能存在 price 和 quantity;存在 price、quantity, 就不能存在 total_fee。 （没绕明白；好吧；那无视这个参数即可）
        "receive_address" => '1', // 收货人地址 即时到账方式无视此参数即可
        "receive_mobile" => '1', // 收货人手机号码 即时到账方式无视即可
        "receive_name" => '1', // 收货人姓名 即时到账方式无视即可
        "receive_zip" => '1', // 收货人邮编 即时到账方式无视即可
        "return_url" => $config['return_url'], // 页面跳转 同步通知 页面路径 支付宝处理完请求后,当前页面自 动跳转到商户网站里指定页面的 http 路径。
        "seller_email" => $config['seller_email'], // email 从支付宝商户版个人中心获取
        "service" => "create_direct_pay_by_user", // 接口名称 固定设置为create_direct_pay_by_user
        "show_url" => $config['show_url'], // 商品展示网址,收银台页面上,商品展示的超链接。
        "subject" => $order['subject'] // 商品名称商品的标题/交易标题/订单标 题/订单关键字等
    );
    $alipay=new \AlipaySubmit($config);
    $new=$alipay->buildRequestPara($data);
    $go_pay=$alipay->buildRequestForm($new, 'get','支付');
    echo $go_pay;
}

/**
 * 微信扫码支付
 * @param  array $order 订单 必须包含支付所需要的参数 body(产品描述)、total_fee(订单金额)、out_trade_no(订单号)、product_id(产品id)
 */
function weixinpay($order){
    $order['trade_type']='NATIVE';
    Vendor('Weixinpay.Weixinpay');
    $weixinpay=new \Weixinpay();
    $weixinpay->pay($order);
}

/**
 * 验证AppStore内付
 * @param  string $receipt_data 付款后凭证
 * @return array                验证是否成功
 */
function validate_apple_pay($receipt_data){
    /**
     * 21000 App Store不能读取你提供的JSON对象
     * 21002 receipt-data域的数据有问题
     * 21003 receipt无法通过验证
     * 21004 提供的shared secret不匹配你账号中的shared secret
     * 21005 receipt服务器当前不可用
     * 21006 receipt合法，但是订阅已过期。服务器接收到这个状态码时，receipt数据仍然会解码并一起发送
     * 21007 receipt是Sandbox receipt，但却发送至生产系统的验证服务
     * 21008 receipt是生产receipt，但却发送至Sandbox环境的验证服务
     */
    function acurl($receipt_data, $sandbox=0){
        //小票信息
        $POSTFIELDS = array("receipt-data" => $receipt_data);
        $POSTFIELDS = json_encode($POSTFIELDS);
 
        //正式购买地址 沙盒购买地址
        $url_buy     = "https://buy.itunes.apple.com/verifyReceipt";
        $url_sandbox = "https://sandbox.itunes.apple.com/verifyReceipt";
        $url = $sandbox ? $url_sandbox : $url_buy;
 
        //简单的curl
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $POSTFIELDS);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    // 验证参数
    if (strlen($receipt_data)<20){
        $result=array(
            'status'=>false,
            'message'=>'非法参数'
            );
        return $result;
    }
    // 请求验证
    $html = acurl($receipt_data);
    $data = json_decode($html,true);
 
    // 如果是沙盒数据 则验证沙盒模式
    if($data['status']=='21007'){
        // 请求验证
        $html = acurl($receipt_data, 1);
        $data = json_decode($html,true);
        $data['sandbox'] = '1';
    }
 
    if (isset($_GET['debug'])) {
        exit(json_encode($data));
    }
     
    // 判断是否购买成功
    if(intval($data['status'])===0){
        $result=array(
            'status'=>true,
            'message'=>'购买成功'
            );
    }else{
        $result=array(
            'status'=>false,
            'message'=>'购买失败 status:'.$data['status']
            );
    }
    return $result;
}


/**
 * geetest检测验证码
 */
function geetest_chcek_verify($data){
    $geetest_id=config('geetest.geetest_id');
    $geetest_key=config('geetest.geetest_key');
    $geetest=new \org\Geetest($geetest_id,$geetest_key);
    $user_id=session('geetest.user_id','','tp5');
    if (session('geetest.gtserver','','tp5')==1) {
        $result=$geetest->success_validate($data['geetest_challenge'], $data['geetest_validate'], $data['geetest_seccode'], $user_id);
        if ($result) {
            return true;
        } else{
            return false;
        }
    }else{
        if ($geetest->fail_validate($data['geetest_challenge'],$data['geetest_validate'],$data['geetest_seccode'])) {
            return true;
        }else{
            return false;
        }
    }
}