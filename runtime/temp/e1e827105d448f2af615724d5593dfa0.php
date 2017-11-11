<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\funs\chou1.html";i:1510369939;s:71:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\public\top.html";i:1509518630;s:72:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\public\left.html";i:1510292249;}*/ ?>
<!DOCTYPE html>
<html><head>
	    <meta charset="utf-8">
    <title>幸运大转盘</title>

    <meta name="description" content="Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--Basic Styles-->
    <link href="__ADMIN__/style/bootstrap.css" rel="stylesheet">
    <link href="__ADMIN__/style/font-awesome.css" rel="stylesheet">
    <link href="__ADMIN__/style/weather-icons.css" rel="stylesheet">
    <style type="text/css">
    .demo{width:417px; height:417px; position:relative; margin:50px auto}
    #disk{width:417px; height:417px; background:url(__ADMIN__/images/disk.jpg) no-repeat}
    #start{width:163px; height:320px; position:absolute; top:46px; left:130px;}
    #start img{cursor:pointer}
    </style>
    <!--Beyond styles-->
    <link id="beyond-link" href="__ADMIN__/style/beyond.css" rel="stylesheet" type="text/css">
    <link href="__ADMIN__/style/typicons.css" rel="stylesheet">
    <link href="__ADMIN__/style/animate.css" rel="stylesheet">
    <link href="__ADMIN__/style/demo.css" rel="stylesheet">
    <script type="text/javascript" src="__ADMIN__/style/jquery-1.11.1.js"></script>
    <script type="text/javascript" src="__ADMIN__/style/jQueryRotate.2.2.js"></script>
    <script type="text/javascript" src="__ADMIN__/style/jquery.easing.min.js"></script>
    <script type="text/javascript">
    $(function(){ 
         $("#startbtn").click(function(){ 
            lottery(); 
        }); 
    }); 
    function lottery(){ 
        $.ajax({ 
            type: 'POST', 
            url: "<?php echo url('funs/run'); ?>",  //提交地址 改为你自己的
            data:{aaa:1},
            dataType: 'json', 
            cache: false, 
            error: function(){ 
                alert('出错了！'); 
                return false; 
            }, 
            success:function(json){ 
                $("#startbtn").unbind('click').css("cursor","default"); 
                var a = json.angle; //角度 
                var p = json.prize; //奖项 
                $("#startbtn").rotate({ 
                    duration:3000, //转动时间 
                    angle: 0, 
                    animateTo:1800+a, //转动角度 
                    easing: $.easing.easeOutSine, 
                    callback: function(){ 
                        var con = confirm('恭喜你，中得'+p+'\n还要再来一次吗？'); 
                        if(con){ 
                            lottery(); 
                        }else{ 
                            return false; 
                        } 
                    } 
                }); 
            } 
        }); 
    } 
    </script>

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
                    <?php if(isset($leftMenus) && isset($rule_access)): if(is_array($leftMenus) || $leftMenus instanceof \think\Collection || $leftMenus instanceof \think\Paginator): $i = 0; $__LIST__ = $leftMenus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if(in_array($vo['id'],$rule_access)): ?>
                    <!-- 第一层 -->
                        <li>
                            <a href="<?php echo url($vo['name']); ?>" class="menu-dropdown">
                                <i class="menu-icon fa <?php echo $vo['icon']; ?>"></i>
                                <span class="menu-text"><?php echo $vo['title']; ?></span>
                                <i class="menu-expand"></i>
                            </a>
                            <?php if(isset($vo['son'])): ?>
                            <!-- 第二层 -->
                            <ul class="submenu">
                                <?php if(is_array($vo['son']) || $vo['son'] instanceof \think\Collection || $vo['son'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if(in_array($v['id'],$rule_access)): ?>
                                <li>
                                    <a href="<?php echo url($v['name']); ?>">
                                        <i class="menu-icon fa <?php echo $v['icon']; ?>"></i>
                                        <span class="menu-text"><?php echo $v['title']; ?></span>
                                        <i class="menu-expand"></i>
                                    </a>

                                </li>
                                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </ul> 
                            <?php endif; ?>
                        </li>
                    <?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
                   
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
                                        <li class="active">幸运大转盘</li>
                                        </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    <div id="main">
                       <div class="msg"></div>
                       <div class="demo">
                            <div id="disk"></div>
                            <div id="start"><img src="__ADMIN__/images/start.png" id="startbtn"></div>
                       </div>
                    </div>

         		</div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
		</div>	
	</div>

</body>
    <!--Basic Scripts-->
 
<script src="__ADMIN__/style/bootstrap.js"></script>
<script src="__ADMIN__/style/beyond.js"></script>

</html>