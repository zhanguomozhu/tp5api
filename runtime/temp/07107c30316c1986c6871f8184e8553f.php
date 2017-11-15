<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"D:\phpStudy\WWW\tp5api\public/../application/chat\view\ajax\index.html";i:1510733322;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>jQuery在线聊天</title>
<link rel="stylesheet" type="text/css" href="__CHAT__/ajax/css/chat.css" />
<script type="text/javascript" src="__CHAT__/swoole/js/jquery-1.11.1.js"></script>
</head>
<script type="text/javascript">
	var maxID=0;
    function showmsg(){

        $.ajax({
            type:'get',
            url: "<?php echo url('ajax/getmsg'); ?>?maxID="+maxID,
            dataType:'json',
            success:function(res){
                var info= res.data;
                var s="";
                for(var i=0;i<info.length;i++){         
                        s="<div class='message clearfix'><div class='user-logo'><img src='__CHAT__/ajax/img/head/2015.jpg'></div><div class='wrap-text'><h5 class='clearfix'>"+info[i].send+" 对 "+info[i].receive+" 说</h5><div>"+info[i].msg+"</div></div><div class='wrap-ri'><div clsss='clearfix'><span>"+info[i].create_time+
                      "</span></div></div><div style='clear:both;''></div></div>";
                      maxID=info[i].id;
                }
                //把编辑过得消息写入信息框
                $('#show-msg').append(s);
                //设置滚动条卷起高度
                $('#msgdiv').scrollTop=$('#msgdiv').scrollHeight;
            }
         
        })
    }
	
	window.onload=function(){

        //随机选中一个人
        var admin = $('.chat03_name');
        var num = Math.floor(admin.length*Math.random());
        //console.log($(admin[num]).text());
        $("#admin").html($(admin[num]).text());
        $("#admin1").val($(admin[num]).text());

		showmsg();//获得最新聊天内容
		setInterval("showmsg()",2000);//制作轮询(推技术)
	}
</script>
<body>

    <div class="content">
        <div class="chatBox">
            <div class="chatLeft">
                <div class="chat01">
                    <div class="chat01_title">
                        <ul class="talkTo">
                            <li><a href="javascript:;" id='admin'>王旭</a></li></ul>
                        <a class="close_btn" href="javascript:;"></a>
                    </div>
                    <div class="chat01_content" id="msgdiv">
                        <div class="message_box mes3" style="display: block;" id="show-msg">
                        </div>
                    </div>
                </div>
                <div class="chat02">
					<form id="form">
                        <input type="hidden" name="admin" id='admin1'>
                    <div class="chat02_title">
                        <label class="chat02_title_t">
                           聊天对象:
						   <select name="receive">
								<option value="恶魔">恶魔</option>
								<option value="天使">天使</option>
								<option value="玉帝">玉帝</option>
								<option value="王母">王母</option>
								<option value="悟空">悟空</option>
								<option value="八戒">八戒</option>
								<option value="沙僧">沙僧</option>
								<option value="唐僧">唐僧</option>
								<option value="小白龙">小白龙</option>
						   </select>
						</label>
                    </div>
					
                    <div class="chat02_content">
                        <textarea id="msg" name="msg"></textarea>
                    </div>
                    <div class="chat02_bar">
                        <ul>
							<li style="right: 100px; top: 7px;">
								<span id="sendresult"></span>
							</li>
                            <li style="right: 5px; top: 5px;">
								<a href="javascript:;">
									<img src="__CHAT__/ajax/img/send_btn.jpg" onclick="sendmsg()">
								</a>
								</li>
                        </ul>
                    </div>
					</form>
                </div>
            </div>
            <div class="chatRight">
                <div class="chat03">
                    <div class="chat03_title">
                        <label class="chat03_title_t">
                            成员列表</label>
                    </div>
                    <div class="chat03_content">
                        <ul>
                            <li>
                                <label class="online">
                                </label>
                                <a href="javascript:;">
                                    <img src="__CHAT__/ajax/img/head/2013.jpg"></a><a href="javascript:;" class="chat03_name">刘秀</a>
                            </li>
                            <li>
                                <label class="offline">
                                </label>
                                <a href="javascript:;">
                                    <img src="__CHAT__/ajax/img/head/2014.jpg"></a><a href="javascript:;" class="chat03_name">陈诚</a>
                            </li>
                            <li class="choosed">
                                <label class="offline">
                                </label>
                                <a href="javascript:;">
                                    <img src="__CHAT__/ajax/img/head/2015.jpg"></a><a href="javascript:;" class="chat03_name">王旭</a>
                            </li>
                            <li>
                                <label class="offline">
                                </label>
                                <a href="javascript:;">
                                    <img src="__CHAT__/ajax/img/head/2016.jpg"></a><a href="javascript:;" class="chat03_name">张灵</a>
                            </li>
                            <li>
                                <label class="online">
                                </label>
                                <a href="javascript:;">
                                    <img src="__CHAT__/ajax/img/head/2017.jpg"></a><a href="javascript:;" class="chat03_name">吴敬</a>
                            </li>
                            <li>
                                <label class="offline">
                                </label>
                                <a href="javascript:;">
                                    <img src="__CHAT__/ajax/img/head/2018.jpg"></a><a href="javascript:;" class="chat03_name">王海东</a>
                            </li>
                            <li>
                                <label class="offline">
                                </label>
                                <a href="javascript:;">
                                    <img src="__CHAT__/ajax/img/head/2019.jpg"></a><a href="javascript:;" class="chat03_name">郑小勇</a>
                            </li>
                            <li>
                                <label class="online">
                                </label>
                                <a href="javascript:;">
                                    <img src="__CHAT__/ajax/img/head/2020.jpg"></a><a href="javascript:;" class="chat03_name">张珊珊</a>
                            </li>
                            <li>
                                <label class="offline">
                                </label>
                                <a href="javascript:;">
                                    <img src="__CHAT__/ajax/img/head/2021.jpg"></a><a href="javascript:;" class="chat03_name">刘强</a>
                            </li>
                            <li>
                                <label class="offline">
                                </label>
                                <a href="javascript:;">
                                    <img src="__CHAT__/ajax/img/head/2022.jpg"></a><a href="javascript:;" class="chat03_name">程海斌</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div style="clear: both;">
            </div>
        </div>
    </div>
</div>
</body>
<script>
	function sendmsg(){
		//ajax提交数据
        $.ajax({
            type:'post',
            url:"<?php echo url('ajax/sendmsg'); ?>",
            data:new FormData($('#form')[0]),
            dataType:'json',
            processData: false,
            contentType: false,
            success:function(res){
                console.log(res)
                $('#sendresult').html();
                $('#msg').val('');
                setTimeout("hideresult()",3000);
            }
        })
	}
	


	//使消息信息消失
	function hideresult(){
		$("#sendresult").html('');
	}

</script>
</html>