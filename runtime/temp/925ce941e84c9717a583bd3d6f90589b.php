<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\funs\map.html";i:1509594410;s:71:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\public\top.html";i:1509518630;s:72:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\public\left.html";i:1510277372;}*/ ?>
<!DOCTYPE html>
<html><head>
	    <meta charset="utf-8">
    <title>地图定位</title>

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
    <style type="text/css">
        .show_iframe iframe {height: 1000px;width: 100%}
    </style>
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
                                        <li class="active">地图定位</li>
                                        </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <form class="form-horizontal" role="form" action="" method="post">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label no-padding-right">输入地址查询经纬度</label>
                    <div class="col-sm-3">
                        <input class="form-control" placeholder="" name="lnglat" required="" type="text" id="lnglat">
                    </div>
                    <input type="button" id="send" class="btn btn-success" value="点击开始查询">
                </div>
                <div class="form-group">
                    <div class="col-sm-2">
                    </div>
                    <p class="col-sm-2 help-block red lnglat">xxx</p>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label no-padding-right">根据经纬度或者地址来获取百度地图</label>
                    <div class="col-sm-3">
                        <input class="form-control" placeholder="" name="address" required="" type="text" id="address">
                    </div>
                    <input type="button" id="send1" class="btn btn-success" value="点击开始查询">
                </div>
                 <div class="form-group">
                    <div class="col-sm-2">
                    </div>
                    <p class="col-sm-2 help-block red address">xxx</p>
                </div>
            </form>
            <div class="show_iframe">
                <iframe scrolling="yes" frameborder="0" src="<?php echo url('showmap'); ?>" id='map'></iframe>
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
            obj.value="点击发送邮件"; 
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
        if($('#lnglat').val()){
             //发送邮件
            $.post("<?php echo url('funs/sendMap'); ?>",{lnglat:$('#lnglat').val(),type:1},function(res){
                //console.log(res)
                if(res.code == 1001){
                    console.log(res.data.data)
                    $(".lnglat").removeClass('red').addClass('green').html('经纬度'+res.data.data.result.location.lng+','+res.data.data.result.location.lat);
                }
                if(res.code == 2001){
                    $(".lnglat").html(res.msg);
                }
            },"json");

            //倒数60s
            settime(this);

        }else{
            $('.lnglat').html('请输入经纬度');
        }
        
    })


    //点击事件
    $('#send1').click(function(){
        if($('#address').val()){
             //发送邮件
            $.post("<?php echo url('funs/sendMap'); ?>",{address:$('#address').val(),type:2},function(res){
                //console.log(res)
                if(res.code == 1001){
                    $('#map').attr('src',res.data.data);
                    $(".address").removeClass('red').addClass('green').html(res.msg);
                }
                if(res.code == 2001){
                    $(".address").html(res.msg);
                }
            },"json");

            //倒数60s
            settime(this);

        }else{
            $('.address').html('请输入经纬度或者地址');
        }
        
    })
    </script>

</body></html>