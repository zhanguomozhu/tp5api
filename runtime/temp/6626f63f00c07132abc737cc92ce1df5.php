<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\login\register.html";i:1510295156;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><!--Head--><head>
    <meta charset="utf-8">
    <title>注册</title>
    <meta name="description" content="login page">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--Basic Styles-->
    <link href="__ADMIN__/style/bootstrap.css" rel="stylesheet">
    <link href="__ADMIN__/style/font-awesome.css" rel="stylesheet">
    <!--Beyond styles-->
    <link id="beyond-link" href="__ADMIN__/style/beyond.css" rel="stylesheet">
    <link href="__ADMIN__/style/demo.css" rel="stylesheet">
    <link href="__ADMIN__/style/animate.css" rel="stylesheet">
</head>
<!--Head Ends-->
<!--Body-->

<body>
    <div class="login-container animated fadeInDown">
        <form action="<?php echo url('register'); ?>" method="post">
            <div class="loginbox bg-white">
                <div class="loginbox-title">管理员注册</div>
                <div class="loginbox-textbox" id="username">
                    <input value="" class="form-control" placeholder="用户名" name="username" type="text">
                    <span class="red"></span>
                    <span class="success"></span>
                </div>
                <div class="loginbox-textbox" id="password">
                    <input class="form-control" placeholder="密码" name="password" type="password">
                    <span class="red"></span>
                    <span class="success"></span>
                </div>
                <div class="loginbox-textbox" id="password1">
                    <input class="form-control" placeholder="确认密码" name="password1" type="password">
                    <span class="red"></span>
                    <span class="success"></span>
                </div>
                <div class="loginbox-textbox" id="phone">
                    <input class="form-control" placeholder="手机号" name="phone" type="text">
                    <span class="red"></span>
                    <span class="success"></span>
                </div>
                <div class="loginbox-textbox" id="code">
                    <input class="form-control" style="width: 125px;float: left;margin-right: 3px;" placeholder="手机验证码" name="code" type="text" >
                    <a href="javascript:void(0);" class="btn btn-default">获取验证码</a>
                    <span class="red"></span>
                    <span class="success"></span>
                </div>

                <div class="loginbox-textbox">
                    <div id="captcha"></div> 
                </div>
                <div class="loginbox-textbox">
                    <a href="javascript:void(0);" onclick="check_verify()" class="btn btn-default">异步验证</a>
                </div>
                <div class="loginbox-submit" style="margin-top: 40px;">
                    <input class="btn btn-primary btn-block" value="注册" type="submit">
                    <p class="text-center">
                        <a  href="<?php echo url('login'); ?>">已有账号点击这里登录</a>
                    </p>
                </div>
            </div>
                <div class="logobox">
                    <p class="text-center">ThinkPHP功能集锦</p>
                </div>
        </form>
    </div>
    <!--Basic Scripts-->
    <script src="__ADMIN__/style/jquery-1.11.1.js"></script>
    <script src="__ADMIN__/style/bootstrap.js"></script>
    <script src="http://static.geetest.com/static/tools/gt.js"></script>
    <!--Beyond Scripts-->
    <script type="text/javascript">
    //验证用户名   
    $("input[name='username']").focus(function(){
        $("#username .red").html('中文、字母、数字等组合,4-18个字符');
    });

    //验证用户名是否存在
    $("input[name='username']").blur(function(){
        if($(this).val().length!=0)
        {
            $.post("<?php echo url('login/yanzheng'); ?>",{username:$(this).val()},function(res){
                if(res.code == 1031){
                    $("#username .red").html(res.msg);
                }
                if(res.code == 1032){
                    $("#username .red").html('');
                    $("#username .success").html(res.msg);
                }
            },"json");  
        } 
        if($(this).val().length>18||$(this).val().length<4){
             $("#username .red").html('用户名不能为空');
        }   
    });




    //验证密码
    $("input[name='password']").focus(function(){
        $("#password .red").html("中文、字母、数字等组合,4-18个字符");
    });
    //验证密码是否为空
    $("input[name='password']").blur(function(){
        if($(this).val().length>18 || $(this).val().length<4){
            $("#password .red").html('密码不能为空');
        }else{
            $("#password .red").html('');
            $("#password .success").html('输入密码');
        }
    });


    //验证重复密码
    $("input[name='password1']").focus(function(){
        $("#password1 .red").html("请再次输入密码！");
    });
    //验证密码是否一致
    $("input[name='password1']").blur(function(){
        if($(this).val()!=$("input[name='password']").val()){
            $("#password1 .red").html('密码不一致');
        }
        if($(this).val()!='' && $(this).val()==$("input[name='password']").val()){
            $("#password1 .red").html('');
            $("#password1 .success").html('密码一致');
        }
     });
    //验证手机
    $("input[name='phone']").focus(function(){
        $("#phone .red").html("建议使用常用手机！");
    });
   

     $("input[name='phone']").blur(function(){ 
        //验证手机是否为空和长度
        if($(this).val().length!=11 || $(this).val().length==0){
            $("#phone .red").html('手机号不能为空，长度11位');
        }else{
            //验证手机号码是否已注册
            if($(this).val().match(/^1[34578]\d{9}$/))
            {
                $.post("<?php echo url('login/yanzheng'); ?>",{phone:$(this).val()},function(res){
                    if(res.code == 1033){
                        $("#phone .red").html(res.msg);
                    }
                    if(res.code == 1034){
                        $("#phone .red").html('');
                        $("#phone .success").html(res.msg);
                    }
                },"json");  
            }else{
                $("#phone .red").html('手机号格式不正确');
            }
        }
        
    });


     
 // //验证邮箱
 //    $("input[name='email']").focus(function(){
 //        $(".ad").html("请使用正确的邮箱").css({'color':'blue','fontSize':'12','line-height':'40px'});
 //    });
 //    //验证邮箱是否符合格式
 //    $("input[name='email']").blur(function(){
 //        if(!$(this).val().match(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/) || $(this).val().length==0){
 //            $(".ad").html('不符合规则,也不能为空').css({'color':'red','line-height':'40px'});
 //        }
 //    });
 //    //验证邮箱是否存在
 //    $("input[name='email']").blur(function(){ 
 //        if($(this).val().match(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/))
 //        {
 //            var data='email='+$(this).val();
 //            $.post("<?php echo url('Admin/Register/yanzheng'); ?>",data,function(res){
 //                $(".ad").html(res).css({'color':'red','line-height':'40px'});
 //            },"text");  
 //        }          
 //    });
    //***************************************验证短信验证码*********************************************
    /*$("#send").click(function(){
            $.post("",{to:$("#iphone").val()},function(data,textStatus){
            $(".af").html(data).css({'color':'green','fontSize':'12'});
        })
    });*/
    // //短信验证码书否为空
    // $("input[name='msgcode']").blur(function(){
    //     if($(this).val().length==0){
    //         $(".af").html('不能为空').css({'color':'red','line-height':'40px'});
    //     }else if($(this).val().length!=6){
    //         $(".af").html('长度不够').css({'color':'red','line-height':'40px'});
    //     }
    // });
    //验证短信验证码是否正确
    //  $("input[name='msgcode']").blur(function(){ 
    //     if($(this).val().length==6)
    //     {
    //         $.post("",{msgcode:$(this).val(),tel:$("input[name='iphone']").val()},function(res){
    //             $(".af").html(res).css({'color':'red','line-height':'40px'});
    //         },"text");  
    //     }          
    // });

    // //验证图片验证码
    // $("input[name='code']").blur(function(){
    //     if($(this).val().length!=4){
    //         $(".ag").html('不能为空').css({'color':'red','line-height':'40px'});
    //     }
    // });
    // //验证图片验证码是否正确
    //  $("input[name='code']").blur(function(){ 
    //     if($(this).val().length==3)
    //     {
    //         var data='code='+$(this).val();
    //         $.post("",data,function(res){
    //             $(".ag").html(res).css({'color':'red','line-height':'40px'});
    //         },"text");  
    //     }          
    // });
    //*****************************************滑动验证*************************************************
     var handler = function (captchaObj) {
        // 将验证码加到id为captcha的元素里
        captchaObj.appendTo("#captcha");
     };
    // 获取验证码
    $.get("<?php echo url('admin/login/geetest_show_verify'); ?>", function(data) {
        //console.log(data)
        // 使用initGeetest接口
        // 参数1：配置参数，与创建Geetest实例时接受的参数一致
        // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
        initGeetest({
            gt: data.gt,
            challenge: data.challenge,
            product: "float", // 产品形式
            offline: !data.success
        }, handler);
    },'json');
    // 检测验证码
    function check_verify(){
        // 组合验证需要用的数据
        var test=$('.geetest_challenge').val();
        var postData={
            geetest_challenge: $('.geetest_challenge').val(),
            geetest_validate: $('.geetest_validate').val(),
            geetest_seccode: $('.geetest_seccode').val()
        }
        console.log(postData)
        // 验证是否通过
        $.post("<?php echo url('admin/login/geetest_ajax_check'); ?>", postData, function(data) {
            if (data==1) {
                alert('验证成功');
            }else{
                alert('验证失败');
            }
        });
    }




    </script>



</body><!--Body Ends--></html>