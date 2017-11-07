<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:73:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\funs\qrcode1.html";i:1509417870;s:71:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\public\top.html";i:1509518630;s:72:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\public\left.html";i:1510026062;}*/ ?>
<!DOCTYPE html>
<html><head>
	    <meta charset="utf-8">
    <title>生成二维码</title>

    <meta name="description" content="Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--Basic Styles-->
    <link href="__ADMIN__/style/bootstrap.css" rel="stylesheet">
    <link href="__ADMIN__/style/font-awesome.css" rel="stylesheet">
    <link href="__ADMIN__/style/weather-icons.css" rel="stylesheet">

    <!--Beyond styles-->
    <link id="beyond-link" href="__ADMIN__/style/beyond.css" rel="stylesheet" type="text/css">
    <link href="__ADMIN__/style/demo.css" rel="stylesheet">
    <link href="__ADMIN__/style/typicons.css" rel="stylesheet">
    <link href="__ADMIN__/style/animate.css" rel="stylesheet">
    
</head>
<body>
	<!-- 头部 -->
	    <div class="navbar">
    <div class="navbar-inner">
        <div class="navbar-container">
            <!-- Navbar Barnd -->
            <div class="navbar-header pull-left">
                <a href="#" class="navbar-brand">
                    <small>
                            <img src="__ADMIN__/images/logo.png" alt="">
                        </small>
                </a>
            </div>
            <!-- /Navbar Barnd -->
            <!-- Sidebar Collapse -->
            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="collapse-icon fa fa-bars"></i>
            </div>
            <!-- /Sidebar Collapse -->
             <!-- 登录开始-->
            <div class="navbar-header pull-right">
                <div class="navbar-account">
                    <ul class="account-area">
                        <li>
                            <a class="login-area dropdown-toggle" data-toggle="dropdown">
                                <div class="avatar" title="View your public profile">
                                    <img src="__ADMIN__/images/adam-jansen.jpg">
                                </div>
                                <section>
                                    <h2><span class="profile"><span><?php echo $user; ?></span></span></h2>
                                </section>
                            </a>
                            <!--Login Area Dropdown-->
                            <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                                <li class="username"><a>David Stevenson</a></li>
                                <li class="dropdown-footer">
                                    <a href="<?php echo url('admin/loginout'); ?>">
                                            退出登录
                                        </a>
                                </li>
                                <li class="dropdown-footer">
                                    <a href="<?php echo url('admin/changePW'); ?>">
                                            修改密码
                                        </a>
                                </li>
                            </ul>
                            <!--/Login Area Dropdown-->
                        </li>
                        <!-- /Account Area -->
                        <!--Note: notice that setting div must start right after account area list.
                            no space must be between these elements-->
                        <!-- Settings -->
                    </ul>
                </div>
            </div>
           <!-- 登录结束-->
        </div>
    </div>
</div>
	<!-- /头部 -->
	
	<div class="main-container container-fluid">
		<div class="page-container">
			<!-- Page Sidebar -->
                      <div class="page-sidebar" id="sidebar">
                <!-- Page Sidebar Header-->
                <div class="sidebar-header-wrapper">
                    <input class="searchinput" type="text">
                    <i class="searchicon fa fa-search"></i>
                    <div class="searchhelper">没啥用啊</div>
                </div>
                <!-- /Page Sidebar Header -->
                <!-- Sidebar Menu -->
                <ul class="nav sidebar-menu">
                    <!--Dashboard-->
                    <?php if(isset($leftMenus)): if(is_array($leftMenus) || $leftMenus instanceof \think\Collection || $leftMenus instanceof \think\Paginator): $i = 0; $__LIST__ = $leftMenus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li>
                            <a href="<?php echo url($vo['path']); ?>" class="menu-dropdown">
                                <i class="menu-icon fa <?php echo $vo['icon']; ?>"></i>
                                <span class="menu-text"><?php echo $vo['title']; ?></span>
                                <i class="menu-expand"></i>
                            </a>
                            <?php if(isset($vo['son'])): ?>
                            <ul class="submenu">
                                <?php if(is_array($vo['son']) || $vo['son'] instanceof \think\Collection || $vo['son'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                <li>
                                    <a href="<?php echo url($v['path']); ?>">
                                        <i class="menu-icon fa <?php echo $v['icon']; ?>"></i>
                                        <span class="menu-text"><?php echo $v['title']; ?></span>
                                        <i class="menu-expand"></i>
                                    </a>
                                </li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul> 
                            <?php endif; ?>
                        </li>

                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>





                    <!-- <li>
                        <a href="<?php echo url('index/index'); ?>" class="menu-dropdown">
                            <i class="menu-icon fa fa-th-large"></i>
                            <span class="menu-text">后台首页</span>
                            <i class="menu-expand"></i>
                        </a>                           
                    </li>
                    <li>
                        <a href="" class="menu-dropdown">
                            <i class="menu-icon fa fa-key"></i>
                            <span class="menu-text">权限管理</span>
                            <i class="menu-expand"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="<?php echo url('Menu/lst'); ?>">
                                    <span class="menu-text">菜单管理</span>
                                    <i class="menu-expand"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo url('Admin/lst'); ?>">
                                    <span class="menu-text">用户管理</span>
                                    <i class="menu-expand"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo url('AuthGroup/lst'); ?>">
                                    <span class="menu-text">角色管理</span>
                                    <i class="menu-expand"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo url('AuthRule/lst'); ?>">
                                    <span class="menu-text">权限管理</span>
                                    <i class="menu-expand"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo url('cate/index'); ?>" class="menu-dropdown">
                            <i class="menu-icon fa fa-folder-o"></i>
                            <span class="menu-text">常用函数</span>
                            <i class="menu-expand"></i>
                        </a>                           
                    </li>
                    <li>
                        <a href="<?php echo url('lists/index'); ?>" class="menu-dropdown">
                            <i class="menu-icon fa  fa-tasks"></i>
                            <span class="menu-text">常用功能</span>
                            <i class="menu-expand"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo url('link/index'); ?>" class="menu-dropdown">
                            <i class="menu-icon fa  fa-link"></i>
                            <span class="menu-text">api功能</span>
                            <i class="menu-expand"></i>
                        </a>
                    </li> 
                     <li>
                        <a href="<?php echo url('link/index'); ?>" class="menu-dropdown">
                            <i class="menu-icon fa  fa-chain-broken"></i>
                            <span class="menu-text">api测试</span>
                            <i class="menu-expand"></i>
                        </a>
                    </li>    -->
                   
                </ul>
                <!-- /Sidebar Menu -->
            </div>
            <!-- /Page Sidebar -->
            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                                        <li>
                        <a href="<?php echo url('Index/index'); ?>">系统</a>
                    </li>
                                        <li class="active">生成二维码</li>
                                        </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-header bordered-bottom bordered-blue">
                <span class="widget-caption">生成二维码</span>
            </div>
            <div class="widget-body">
                <div id="horizontal-form">
                    <form class="form-horizontal" role="form" action="" method="post">
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">url</label>
                            <div class="col-sm-3">
                                <input class="form-control" placeholder="" name="url" required="" type="text" id="url">
                            </div>
                            <p class="help-block col-sm-6 red url">*必填</p>
                        </div> 
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">版本号</label>
                            <div class="col-sm-3">
                                <input class="form-control" placeholder="" name="version" required="" type="text" id="version">
                            </div>
                             <p class="help-block col-sm-6 red version">QR码符号共有40种规格的矩阵，从21x21（版本1），到177x177（版本40），每一版本符号比前一版本 每边增加4个模块。</p>
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">容错级别</label>
                            <div class="col-sm-3">
                                <input class="form-control" placeholder="" name="error" required="" type="text" id="error">
                            </div>
                            <p class="help-block col-sm-6 red error"> 2的容错率:30%,容错级别：0：15%，1：7%，2：30%，3：25%</p>

                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">QR码模块大小</label>
                            <div class="col-sm-3">
                                <input class="form-control" placeholder="" name="msize" required="" type="text" id="msize">
                            </div>
                             <p class="help-block col-sm-6 red msize">1.2.3.4...10</p>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">保存类型</label>
                            <div class="col-sm-3">
                                <input class="form-control" placeholder="" name="type" required="" type="text" id="type">
                            </div>
                            <p class="help-block col-sm-6 red type">png.jpg.jpeg</p>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">中间logo图片</label>
                            <div class="col-sm-3">
                                <input class="form-control" placeholder="" name="logo" required="" type="text" id="logo">
                            </div>
                             <p class="help-block col-sm-6 red logo">./static/admin/images/adam-jansen.jpg</p>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">二维码大小</label>
                            <div class="col-sm-3">
                                <input class="form-control" placeholder="" name="size" required="" type="text" id="size">
                            </div>
                            <p class="help-block col-sm-6 red size">px</p>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">边框宽度</label>
                            <div class="col-sm-3">
                                <input class="form-control" placeholder="" name="width" required="" type="text" id="width">
                            </div>
                            <p class="help-block col-sm-6 red width">px,默认16px</p>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">模块间距</label>
                            <div class="col-sm-3">
                                <input class="form-control" placeholder="" name="padding" required="" type="text" id="padding">
                            </div>
                             <p class="help-block col-sm-6 red padding">true.false</p>
                        </div>
                         <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">边框</label>
                            <div class="col-sm-3">
                                <input class="form-control" placeholder="" name="border" required="" type="text" id="border">
                            </div>
                             <p class="help-block col-sm-6 red border">true.false</p>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">生成的图片标签文字</label>
                            <div class="col-sm-3">
                                <input class="form-control" placeholder="" name="tagtext" required="" type="text" id="tagtext">
                            </div>
                             <p class="help-block col-sm-6 red tagtext"></p>
                        </div>
                         <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">标签文字大小</label>
                            <div class="col-sm-3">
                                <input class="form-control" placeholder="" name="tagsize" required="" type="text" id="tagsize">
                            </div>
                             <p class="help-block col-sm-6 red tagsize">px</p>
                        </div>
                         <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">标签字体</label>
                            <div class="col-sm-3">
                                <input class="form-control" placeholder="" name="tagfont" required="" type="text" id="tagfont">
                            </div>
                             <p class="help-block col-sm-6 red tagfont">./static/qrcode/fonts/STXINGKA.TTF</p>
                        </div>
                         <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">二维码的颜色</label>
                            <div class="col-sm-3">
                                红<input class="form-control" placeholder="" name="qr" required="" type="text" id="qr">
                                绿<input class="form-control" placeholder="" name="qg" required="" type="text" id="qg">
                                蓝<input class="form-control" placeholder="" name="qb" required="" type="text" id="qb">
                                透明度<input class="form-control" placeholder="" name="qa" required="" type="text" id="qa">
                            </div>
                             <p class="help-block col-sm-6 red color">0-255</p>
                        </div>
                         <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">生成图片背景颜色</label>
                            <div class="col-sm-3">
                                红<input class="form-control" placeholder="" name="br" required="" type="text" id="br">
                                绿<input class="form-control" placeholder="" name="bg" required="" type="text" id="bg">
                                蓝<input class="form-control" placeholder="" name="bb" required="" type="text" id="bb">
                                透明度<input class="form-control" placeholder="" name="ba" required="" type="text" id="ba">
                            </div>
                             <p class="help-block col-sm-6 red bcolor">0-255</p>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">二维码文件名</label>
                            <div class="col-sm-3">
                                <input class="form-control" placeholder="" name="name" required="" type="text" id="name">
                            </div>
                             <p class="help-block col-sm-6 red name">./qrcode/qqq.png</p>
                        </div>
                        <div class="form-group" style="width: 40%;margin: 0 auto;margin-left: 10%; border: 1px solid red;" >
                            <div  style="text-align: center;">
                                <img src="/static/admin/images/adam-jansen.jpg" id='qrcode' style="padding: 100px;" >
                            </div>
                            <p class="help-block col-sm-6 red qrcode"></p>
                        </div> 
                        <div class="form-group" style="margin-top: 20px;">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-6">
                               <input type="button" id="send" class="btn btn-success" value="点击生成二维码">
                            </div>
                        </div>
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
		</div>	
	</div>

	    <!--Basic Scripts-->
    <script src="__ADMIN__/style/jquery_002.js"></script>
    <script src="__ADMIN__/style/bootstrap.js"></script>
    <script src="__ADMIN__/style/jquery.js"></script>
    <!--Beyond Scripts-->
    <script src="__ADMIN__/style/beyond.js"></script>
    <script type="text/javascript">
    var countdown=60; 
    function settime(obj) { 
        if (countdown == 0) { 
            obj.removeAttribute("disabled");    
            obj.value="点击验证码"; 
            countdown = 60; 
            return;
        } else { 
            obj.setAttribute("disabled", true); 
            obj.value="重新发送(" + countdown + ")"; 
            countdown--; 
        } 
    setTimeout(function() { 
        settime(obj) }
        ,1000) 
    }

 
      
    //点击事件
    $('#send').click(function(){
        var httpURL = $("#url").val();
        var version = $("#version").val();
        var error   = $("#error").val();
        var msize   = $("#msize").val();
        var type    = $("#type").val();
        var logo    = $("#logo").val();
        var size    = $("#size").val();
        var width   = $("#width").val();
        var padding = $("#padding").val();
        var border = $("#border").val();
        var tagtext = $("#tagtext").val();
        var tagsize = $("#tagsize").val();
        var tagfont = $("#tagfont").val();
        var qr   = $("#qr").val();
        var qg   = $("#qg").val();
        var qb   = $("#qb").val();
        var qa   = $("#qa").val();
        var br  = $("#br").val();
        var bg  = $("#bg").val();
        var bb  = $("#bb").val();
        var ba  = $("#ba").val();
        var name    = $("#name").val();

        if(httpURL){
            //检测手机号格式
            if(httpURL.match(/^((ht|f)tps?):\/\/[\w\-]+(\.[\w\-]+)+([\w\-\.,@?^=%&:\/~\+#]*[\w\-\@?^=%&\/~\+#])?$/)){
                    $.post("<?php echo url('funs/setQrCode2'); ?>",
                    {
                        httpURL:httpURL,
                        qversion:version,
                        qerror:error,
                        qmsize:msize,
                        qtype:type,
                        qlogo:logo,
                        qsize:size,
                        qwidth:width,
                        qpadding:padding,
                        qborder:border,
                        qtagtext:tagtext,
                        qtagsize:tagsize,
                        qtagfont:tagfont,
                        qr:qr,
                        qg:qg,
                        qb:qb,
                        qa:qa,
                        br:br,
                        bg:bg,
                        bb:bb,
                        ba:ba,
                        qname:name,
                    },function(res){
                        $('.qrcode').html(res.msg);
                        $('#qrcode').attr('src',res.data.qrcode);
                    },"json");
                    
                    //倒数60s
                    settime(this);
            }else{
                $('.url').html('url格式不正确');
            }
            
        }else{
            $('.url').html('请输入url地址');
        }
        
    })
    </script>


</body></html>