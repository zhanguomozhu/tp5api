<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"D:\phpStudy\WWW\tp5api\public/../application/push\view\index\index.html";i:1510800397;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>即时通讯系统</title>
<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
</head>
<style type="text/css">
	
.but {
    height: 48px;
    width: 100px;
    background: #943F95;
    font-size: 24px;
    border-radius: 5%;
    border:0px;
}
</style>
<body>
	<div id="convo">  
		<ul class="chat-thread">
		</ul>
		<div class="chat-window">
			<input class="chat-window-message" name="chat-window-message" autocomplete="on" placeholder="请输入内容按回车键发送" type="text">
			<button class="but" onclick="speak_to_all()">发送</button>
		</div>
	</div>
 <script src='jquery.js'></script>
 <script type="text/javascript">
 	var name=prompt("请填写昵称");

	//打开websocket
	ws = new WebSocket("ws://tp5api.com:2346");

	//链接服务器
 	ws.onopen=function(eve){
 		//append_speak('服务器链接成功');
 		doSend(name+'加入了聊天室');
 	}

 	//链接错误
 	ws.onerror = function () {
        var data = "系统消息 : 出错了,请退出重试.";
        append_speak(data);
    };

    //消息处理
    ws.onmessage=function(eve){
    	console.log(eve)
    	append_speak(eve.data);
    }


    //关闭链接
    ws.onclose=function(eve){
    	console.log(eve)
    	append_speak(name+'离开了聊天室');
    }


	//发送消息
	function doSend(msg){
		console.log(msg)
		ws.send(msg);
	}

	//按下了回车键之后
	$(document).keypress(function(event){
        if(event.keyCode==13){
             speak_to_all(); //插入发言
        } 
	}); 
	   
     //消息内容发送到
    function speak_to_all(){

        var speak=$(".chat-window-message").val(); //获得文本框内容
        var msg = name+'说：'+speak;
        doSend(msg);
        //清除消息内容
        $(".chat-window-message").val('');
    }

   
    //往内容框中输入
    function append_speak(new_msg){

        $(".chat-thread").append("<li>"+new_msg+"</li>");
        //滚动条下移到最后
        $(".chat-thread").scrollTop($('.chat-thread')[0].scrollHeight);
    }
 </script>
</body>

</html>
