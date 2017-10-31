<?php 
/**
 * 发送邮件类库
 */
namespace phpmail;
 class Email
 {
 	/**
 	 * [send description]
 	 * @param  [type] $to      [发送给谁]
 	 * @param  [type] $title   [标题]
 	 * @param  [type] $content [内容]
 	 * @return [type]          [bool]
 	 */
 	public static function send($to,$title,$content)
 	{	
 		date_default_timezone_set('PRC');//设置时区
 		try{
	 		$email_smtp=config('email.email_smtp');
		    $email_username=config('email.email_username');
		    $email_password=config('email.email_password');
		    $email_from_name=config('email.email_from_name');
		    $email_smtp_secure=config('email.email_smtp_secure');
		    $email_port=config('email.email_port');
		    if(empty($email_smtp) || empty($email_username) || empty($email_password) || empty($email_from_name)){
		        return array("error"=>1,"message"=>'邮箱配置不完整');
		    }
	/*	    require_once '../extend/phpmail/class.phpmailer.php';
		    require_once '../extend/phpmail/class.smtp.php';*/
		    $phpmailer=new Phpmailer();
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
		    if(is_array($to)){
		        foreach($to as $tov){
		            $phpmailer->addAddress($tov);
		        }
		    }else{
		        $phpmailer->addAddress($to);
		    }
		    // 设置邮件标题
		    $phpmailer->Subject=$title;
		    // 设置邮件正文
		    $phpmailer->Body=$content;
		    // 发送邮件。
		    if(!$phpmailer->Send()) {
		        $phpmailererror=$phpmailer->ErrorInfo;
		        return array("error"=>1,"message"=>$phpmailererror);
		    }else{
		        return array("error"=>0,"message"=>'发送成功');
		    }
	    }catch(phpmailerException $e){
	    	return false;
	    }

 	}
 }