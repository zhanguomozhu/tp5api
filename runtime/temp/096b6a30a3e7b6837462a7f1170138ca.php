<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\sfun\index.html";i:1510026364;s:71:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\public\top.html";i:1509518630;s:72:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\public\left.html";i:1510026062;}*/ ?>
<!DOCTYPE html>
<html><head>
	    <meta charset="utf-8">
    <title>小功能</title>

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
    <script type="text/javascript" charset="utf-8" src="__ADMIN__/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="__ADMIN__/ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="__ADMIN__/ueditor/lang/zh-cn/zh-cn.js"></script>

    
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
                                        <li class="active">小功能</li>
                                        </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-header bordered-bottom bordered-blue">
                <span class="widget-caption">
                    <!-- 万年历 -->
                    <script type="text/javascript" charset="utf-8" src="__ADMIN__/style/clock.js"></script>
                    <script type="text/javascript">showcal();</script>
                </span>
            </div>
            <div class="widget-body">
                <div id="horizontal-form">
                    <form class="form-horizontal" role="form" action="" method="post">
                       <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">加密字符串</label>
                            <div class="col-sm-4">
                                <input class="form-control" placeholder="" name="encstr1" required="" type="text" id="encstr1">
                            </div>
                            <div class="col-sm-1">
                                <input type="button" id="send_encstr1" class="btn btn-success" value="点击开始加密">
                            </div>
                            <div class="col-sm-4">
                                <p class="red encstr1"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">解密字符串</label>
                            <div class="col-sm-4">
                                <input class="form-control" placeholder="" name="encstr2" required="" type="text" id="encstr2">
                            </div>
                            <div class="col-sm-1">
                                 <input type="button" id="send_encstr2" class="btn btn-success" value="点击开始解密">
                            </div>
                            <div class="col-sm-4">
                                <p class="red encstr2"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">加密URL</label>
                            <div class="col-sm-4">
                                <input class="form-control" placeholder="" name="encurl1" required="" type="text" id="encurl1">
                            </div>
                            <div class="col-sm-1">
                                <input type="button" id="send_encurl1" class="btn btn-success" value="点击开始加密">
                            </div>
                            <div class="col-sm-4">
                                <p class="red encurl1"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">解密URL</label>
                            <div class="col-sm-4">
                                <input class="form-control" placeholder="" name="encurl2" required="" type="text" id="encurl2">
                            </div>
                            <div class="col-sm-1">
                                <input type="button" id="send_encurl2" class="btn btn-success" value="点击开始解密">
                            </div>
                            <div class="col-sm-4">
                                <p class="red encurl2"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">查看星座</label>
                            <div class="col-sm-4">
                                <input class="form-control layui-input" placeholder="" name="sign" required="" type="text" id="sign" placeholder="yyyy-MM-dd">
                            </div>
                            <div class="col-sm-1">
                                <input type="button" id="send_sign" class="btn btn-success" value="点击开始查看">
                            </div>
                            <div class="col-sm-4">
                                <p class="red sign"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">查看ip</label>
                            <div class="col-sm-4">
                                <input class="form-control" placeholder="" name="ip" required="" type="text" id="ip" disabled="disabled">
                            </div>
                            <div class="col-sm-1">
                                <input type="button" id="send_ip" class="btn btn-success" value="点击开始查看">
                            </div>
                            <div class="col-sm-4">
                                <p class="red ip"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">不区分大小写in_array()</label>
                            <div class="col-sm-1">
                                <input class="form-control" placeholder="" name="inArr1" required="" type="text" id="inArr1">
                            </div>
                            <div class="col-sm-3">
                                <input class="form-control" placeholder="" name="inArr2" required="" type="text" id="inArr2">
                            </div>
                            <div class="col-sm-1">
                                <input type="button" id="send_inArr" class="btn btn-success" value="点击开始查看">
                            </div>
                            <div class="col-sm-4">
                                <p class="red inArr"></p>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">转义特殊字符和emoji</label>
                            <div class="col-sm-4">
                                <input class="form-control" placeholder="" name="emoji" required="" type="text" id="emoji">
                            </div>
                            <div class="col-sm-1">
                                <input type="button" id="send_emoji" class="btn btn-success" value="点击开始查看">
                            </div>
                            <div class="col-sm-4">
                                <p class="red emoji"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">是否手机访问</label>
                            <div class="col-sm-4">
                                <input class="form-control" placeholder="" name="phone" required="" type="text" id="phone" disabled="disabled">
                            </div>
                            <div class="col-sm-1">
                                <input type="button" id="send_phone" class="btn btn-success" value="点击开始查看">
                            </div>
                            <div class="col-sm-4">
                                <p class="red phone"></p>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">获取当前设备类型</label>
                            <div class="col-sm-4">
                                <input class="form-control" placeholder="" name="device" required="" type="text" id="device" disabled="disabled">
                            </div>
                            <div class="col-sm-1">
                                <input type="button" id="send_device" class="btn btn-success" value="点击开始查看">
                            </div>
                            <div class="col-sm-4">
                                <p class="red device"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">生成不重复的随机数</label>
                            <div class="col-sm-1">
                                <input class="form-control" placeholder="开始范围" name="start" required="" type="text" id="start">
                            </div>
                            <div class="col-sm-1">
                                <input class="form-control" placeholder="结束范围" name="end" required="" type="text" id="end">
                            </div>
                            <div class="col-sm-2">
                                <input class="form-control" placeholder="个数" name="leng" required="" type="text" id="leng">
                            </div>
                            <div class="col-sm-1">
                                <input type="button" id="send_randnum" class="btn btn-success" value="点击开始查看">
                            </div>
                            <div class="col-sm-4">
                                <p class="red randnum"></p>
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">生成多个不重复随机数</label>
                            <div class="col-sm-1">
                                <input class="form-control" placeholder="数量" name="num" required="" type="text" id="num">
                            </div>
                            <div class="col-sm-1">
                                <input class="form-control" placeholder="长度" name="length" required="" type="text" id="length">
                            </div>
                            <div class="col-sm-2">
                                <input class="form-control" placeholder="类别,0:a,1:A,2:0,3:aA,4:a1,5:A1,其他" name="model" required="" type="text" id="model">
                            </div>
                            <div class="col-sm-1">
                                <input type="button" id="send_morenum" class="btn btn-success" value="点击开始查看">
                            </div>
                            <div class="col-sm-4">
                                <p class="red morenum"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">获取一定范围随机数字</label>
                            <div class="col-sm-2">
                                <input class="form-control" placeholder="开始" name="st" required="" type="text" id="st">
                            </div>
                            <div class="col-sm-2">
                                <input class="form-control" placeholder="结束" name="et" required="" type="text" id="et">
                            </div>
                            <div class="col-sm-1">
                                <input type="button" id="send_fannum" class="btn btn-success" value="点击开始查看">
                            </div>
                            <div class="col-sm-4">
                                <p class="red fannum"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">按符号截取字符串的指定部分</label>
                            <div class="col-sm-2">
                                <input class="form-control" placeholder="字符串" name="string" required="" type="text" id="string">
                            </div>
                            <div class="col-sm-1">
                                <input class="form-control" placeholder="定界符" name="si" required="" type="text" id="si">
                            </div>
                            <div class="col-sm-1">
                                <input class="form-control" placeholder="长度" name="number" required="" type="text" id="number">
                            </div>
                            <div class="col-sm-1">
                                <input type="button" id="send_cutstr" class="btn btn-success" value="点击开始查看">
                            </div>
                            <div class="col-sm-4">
                                <p class="red cutstr"></p>
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">取得根域名</label>
                            <div class="col-sm-4">
                                <input class="form-control" placeholder="域名" name="demaio" required="" type="text" id="demaio" >
                            </div>
                            <div class="col-sm-1">
                                <input type="button" id="send_demaio" class="btn btn-success" value="点击开始查看">
                            </div>
                            <div class="col-sm-4">
                                <p class="red demaio"></p>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">字符串截取，支持中文和其他编码</label>
                            <div class="col-sm-1">
                                <input class="form-control" placeholder="字符" name="str3" required="" type="text" id="str3" >
                            </div>
                            <div class="col-sm-1">
                                <input class="form-control" placeholder="开始位置" name="start3" required="" type="text" id="start3" >
                            </div>
                            <div class="col-sm-1">
                                <input class="form-control" placeholder="截取长度" name="length3" required="" type="text" id="length3" >
                            </div>
                            <div class="col-sm-1">
                                <select name="suffix3" id="suffix3">
                                    <option>截断显示字符</option>
                                    <option value="1">TRUE</option>
                                    <option value="0">FALSE</option>
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <select name="charset3" id="charset3">
                                    <option>编码格式</option>
                                    <option value="utf-8">utf-8</option>
                                    <option value="gb2312">gb2312</option>
                                    <option value="gbk">gbk</option>
                                    <option value="big5">big5</option>
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <input type="button" id="send_str3" class="btn btn-success" value="点击开始查看">
                            </div>
                            <div class="col-sm-4">
                                <p class="red str3"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">计算距离现在的时间</label>
                            <div class="col-sm-2">
                                <input class="form-control" placeholder="yyyy-MM-dd" name="fortime" required="" type="text" id="fortime">
                            </div>
                            <div class="col-sm-2">
                                <input class="form-control" placeholder="HH点mm分ss秒" name="fortime1" required="" type="text" id="fortime1">
                            </div>
                            <div class="col-sm-1">
                                <input type="button" id="send_fortime" class="btn btn-success" value="点击开始查看">
                            </div>
                            <div class="col-sm-4">
                                <p class="red fortime"></p>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">产生唯一名称</label>
                            <div class="col-sm-4">
                                <input class="form-control" placeholder="长度" name="length4" required="" type="text" id="length4" >
                            </div>
                            <div class="col-sm-1">
                                <input type="button" id="send_uniqidName" class="btn btn-success" value="点击开始查看">
                            </div>
                            <div class="col-sm-4">
                                <p class="red uniqidName"></p>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">提示操作信息的，并且跳转</label>
                            <div class="col-sm-2">
                                <input class="form-control" placeholder="展示信息" name="msg" required="" type="text" id="msg" >
                            </div>
                            <div class="col-sm-2">
                                <input class="form-control" placeholder="跳转地址" name="url1" required="" type="text" id="url1" >
                            </div>
                            <div class="col-sm-1">
                                <input type="button" id="send_alerts" class="btn btn-success" value="点击开始查看">
                            </div>
                            <div class="col-sm-4">
                                <p class="red alerts"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">城市二级联动</label>
                            <div class="col-sm-2">
                                <select name="province" id="">
                                    <option value="">请选择</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select name="city">
                                    <option value="">请选择</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">城市三级联动</label>
                            <div class="col-sm-1">
                                <select name="s_province" id="s_province">
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <select name="s_city" id="s_city">
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <select name="s_county" id="s_county">
                                </select>
                            </div>
                            <div class="col-sm-1">
                            </div>
                        </div>



                        <div class="form-group ueimagesss">
                            <label for="username" class="col-sm-2 control-label no-padding-right">获取编辑器图片的路径</label>
                            <div class="col-sm-4">
                                <textarea name="content" id="content">
                                    
                                </textarea>
                            </div>
                            <div class="col-sm-1">
                                <input type="button" id="send_ueimages" class="btn btn-success" value="点击开始查看">
                            </div>
                        </div>
                        <div class="form-group ueimages col-sm-4">
                            
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
    <!-- layui -->
    <script src="/static/layui/layui.js" charset="utf-8"></script>
    <!-- 城市二级联动 -->
    <script src="__ADMIN__/style/city.js" charset="utf-8"></script>
    <!-- 城市三级联动 -->
    <script src="__ADMIN__/style/area.js" charset="utf-8"></script>
    <script type="text/javascript">_init_area();</script>
    <!-- 百度编辑器 -->
    <script type="text/javascript">
         UE.getEditor('content',{
            "initialFrameWidth":"100%",
            "initialFrameHeight":200,
            "maximumWords":50000
          });
    </script>
    <!-- layui -->
    <script>
    layui.use('laydate', function(){
          var laydate = layui.laydate;
          
          //常规用法
          laydate.render({
            elem: '#sign'
          });

          //常规用法
          laydate.render({
            elem: '#fortime'
          });
          //时间
          laydate.render({
            elem: '#fortime1'
            ,type: 'time'
          });
      });
    </script>

    <script type="text/javascript"> 
    //60s倒计时
    var countdown=10; 
    function settime(obj) { 
        if (countdown == 0) { 
            obj.removeAttribute("disabled");    
            obj.value="点击发送邮件"; 
            countdown = 10; 
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

    //ajax请求
    function ajaxPOST($url,$data,$msg){
        $.post($url,$data,function(res){
            if(res.code == 1001){
                $msg.removeClass('red').addClass('green').html(res.msg+' | '+res.data.data);
            }
            if(res.code == 2001){
                $msg.html(res.msg);
            }
        },"json");
    }
      
    //异位或加密字符串
    $('#send_encstr1').click(function(){
        var encstr1 = $('#encstr1').val();
        if(encstr1){
            //加密字符串
            ajaxPOST("<?php echo url('sfun/encstr'); ?>",{str:encstr1,type:0},$('.encstr1'));
            //倒数60s
            settime(this);
        }
        
    })
   
   //异位或解密字符串
    $('#send_encstr2').click(function(){
        var encstr2 = $('#encstr2').val();
        if(encstr2){
            //解密字符串
            ajaxPOST("<?php echo url('sfun/encstr'); ?>",{str:encstr2,type:1},$('.encstr2'));
            //倒数60s
            settime(this);
        }
    })

    //加密url
    $('#send_encurl1').click(function(){
        var encurl1 = $('#encurl1').val();
        if(encurl1){
            //加密url
            ajaxPOST("<?php echo url('sfun/encurl'); ?>",{hurl:encurl1,type:0},$('.encurl1'));
            //倒数60s
            settime(this);
        }
    })
   
   //解密url
   $('#send_encurl2').click(function(){
        var encurl2 = $('#encurl2').val();
        if(encurl2){
            //加密url
            ajaxPOST("<?php echo url('sfun/encurl'); ?>",{hurl:encurl2,type:1},$('.encurl2'));
            //倒数60s
            settime(this);
        }
    })
    


    //星座
    $('#send_sign').click(function(){
        var sign = $('#sign').val();
        if(sign){
            //加密url
            ajaxPOST("<?php echo url('sfun/sign'); ?>",{sign:sign},$('.sign'));
            //倒数60s
            settime(this);
        }
    })


    //IP
    $('#send_ip').click(function(){
        //加密url
        ajaxPOST("<?php echo url('sfun/ipAdress'); ?>",{type:1},$('.ip'));
        //倒数60s
        settime(this);
    })

    //in_array()
    $('#send_inArr').click(function(){
        var inArr1 = $('#inArr1').val();
        var inArr2 = $('#inArr2').val();
        if(inArr1 && inArr2){
            //加密url
            ajaxPOST("<?php echo url('sfun/inArr'); ?>",{inArr1:inArr1,inArr2:inArr2,},$('.inArr'));
            //倒数60s
            settime(this);
        }
        
    })

     //转义表情
    $('#send_emoji').click(function(){
        var emoji = $('#emoji').val();
        if(emoji){
            //加密url
            ajaxPOST("<?php echo url('sfun/emoji'); ?>",{emoji:emoji},$('.emoji'));
            //倒数60s
            settime(this);
        }
    })

     //是否手机访
    $('#send_phone').click(function(){
        //加密url
        ajaxPOST("<?php echo url('sfun/phone'); ?>",{phone:1},$('.phone'));
        //倒数60s
        settime(this);
    })

    
    //获取当前设备类型
    $('#send_device').click(function(){
        //加密url
        ajaxPOST("<?php echo url('sfun/device'); ?>",{device:1},$('.device'));
        //倒数60s
        settime(this);
    })


    //生成不重复的随机数
    $('#send_randnum').click(function(){
        //开始范围
        var start = $("#start").val();
        //结束范围
        var end = $("#end").val();
        //个数
        var leng = $("#leng").val();
        ajaxPOST("<?php echo url('sfun/randnum'); ?>",{start:start,end:end,leng:leng},$('.randnum'));
        //倒数60s
        settime(this);
    })


    //生成多个不重复随机数
    $('#send_morenum').click(function(){
        //数量
        var num = $("#num").val();
        //长度
        var length = $("#length").val();
        //0 小写字母 1大写字母 2 数字 3大小写 4小写与数字 5大写与数字  其它 混合
        var model = $("#model").val();
        ajaxPOST("<?php echo url('sfun/morenum'); ?>",{num:num,leng:length,model:model},$('.morenum'));
        //倒数60s
        settime(this);
        
    })


    //获取一定范围随机数字
    $('#send_fannum').click(function(){
        //开始范围
        var st = $("#st").val();
        //结束范围
        var et = $("#et").val();
        ajaxPOST("<?php echo url('sfun/fannum'); ?>",{st:st,et:et},$('.fannum'));
        //倒数60s
        settime(this);
    })


    //按符号截取字符串的指定部分
    $('#send_cutstr').click(function(){
        //字符串
        var str = $("#string").val();
        //定界符
        var si = $("#si").val();
        //长度
        var number = $("#number").val();
        ajaxPOST("<?php echo url('sfun/cutstr'); ?>",{str:str,si:si,number:number},$('.cutstr'));
        //倒数60s
        settime(this);
    })


    //取得根域名
    $('#send_demaio').click(function(){
        //字符串
        var demaio = $("#demaio").val();
        if(demaio){
            ajaxPOST("<?php echo url('sfun/demaio'); ?>",{demaio:demaio},$('.demaio'));
            //倒数60s
            settime(this);
        }
    })

    //字符串截取，支持中文和其他编码
    $('#send_str3').click(function(){
        //字符串
        var str3 = $("#str3").val();
        var start3 = $("#start3").val();
        var length3 = $("#length3").val();
        var suffix3 = $("#suffix3").val();
        var charset3 = $("#charset3").val();
        if(str3){
            ajaxPOST("<?php echo url('sfun/substrs'); ?>",{str3:str3,start3:start3,length3:length3,suffix3:suffix3,charset3:charset3},$('.str3'));
            //倒数60s
            settime(this);
        }
    })


     //计算距离现在的时间
    $('#send_fortime').click(function(){
        //字符串
        var fortime = $("#fortime").val();
        var fortime1 = $("#fortime1").val();
        ajaxPOST("<?php echo url('sfun/fortime'); ?>",{fortime:fortime,fortime1:fortime1},$('.fortime'));
        //倒数60s
        settime(this);
    })


     //产生唯一名称
    $('#send_uniqidName').click(function(){
        //字符串
        var length4 = $("#length4").val();
        ajaxPOST("<?php echo url('sfun/uniqidName'); ?>",{length4:length4},$('.uniqidName'));
        //倒数60s
        settime(this);
    })

    //提示操作信息的，并且跳转
    $('#send_alerts').click(function(){
        //字符串
        var msg = $("#msg").val();
        var url1 = $("#url1").val();
        if(msg && url1){
            ajaxPOST("<?php echo url('sfun/alerts'); ?>",{msg:msg,url:url1},$('.alerts'));
            //倒数60s
            settime(this);
        }
    })

    //获取编辑器图片
    $('#send_ueimages').click(function(){
        //字符串
        var str4 = UE.getEditor('content').getContent();
        ajaxPOST("<?php echo url('sfun/ueimages'); ?>",{str4:str4},$('.ueimages'));
        $('.ueimagesss').hide();
        //倒数60s
        settime(this);
    })


    //二级城市联动
    var province = '';
    $.each(city, function (i, k) {
        province += '<option value="' + k.name + '" index="' + i + '">' + k.name + '</option>';
    });
    $('select[name=province]').append(province).change(function () {
        var option = '';
        if ($(this).val() == '') {
            option += '<option value="">请选择</option>';
        } else {
            var index = $(':selected', this).attr('index');
            var data = city[index].child;
            for (var i = 0; i < data.length; i++) {
                option += '<option value="' + data[i] + '">' + data[i] + '</option>';
            }
        }
        
        $('select[name=city]').html(option);
    });
    </script>

</body></html>