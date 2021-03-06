<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\index\index.html";i:1510027718;s:71:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\public\top.html";i:1509518630;s:72:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\public\left.html";i:1510292249;}*/ ?>
<!DOCTYPE html>
<html><head>
	    <meta charset="utf-8">
    <title>ThinkPHP功能集锦</title>

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
    <!-- 万年历 -->
    <script type="text/javascript" charset="utf-8" src="__ADMIN__/style/clock.js"></script>
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
                                        <li class="active">控制面板</li>
                                        </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
				<div style="text-align:center; line-height:1000%;">
                <table class="table table-bordered table-hover">
                        <thead class="">
                            <tr>
                                <th class="text-center" colspan="2">网站配置信息</th>
                            </tr>
                            <tr>
                                <th class="text-center" colspan="2"><script type="text/javascript">showcal();</script></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <td align="center" style="width: 30%;">管理员</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['username']; ?></td>
                            </tr>
                            <tr>
                                <td align="center" style="width: 30%;">登录时间</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['logintime']; ?></td>
                            </tr>
                            <tr>
                                <td align="center" style="width: 30%;">登录IP</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['loginip']; ?></td>
                            </tr>
                            <tr>
                                <td align="center" style="width: 30%;">登录地址</td>
                                <td align="left" style="width: 70%;" id='getip'></td>
                            </tr>
                            <tr>
                                <td align="center" style="width: 30%;">登陆次数</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['num']; ?></td>
                            </tr>
                            <tr>
                                <td align="center" style="width: 30%;">操作系统</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['os']; ?></td>
                            </tr>
                            <tr>
                                <td align="center" style="width: 30%;">运行环境</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['huanjing']; ?></td>
                            </tr>
                             <tr>
                                <td align="center" style="width: 30%;">当前主机名</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['pc']; ?></td>
                            </tr>
                             <tr>
                                <td align="center" style="width: 30%;">获取服务器语言</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['language']; ?></td>
                            </tr>
                             <tr>
                                <td align="center" style="width: 30%;">端口</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['port']; ?></td>
                            </tr>
                            <tr>
                                <td align="center" style="width: 30%;">PHP版本</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['php']; ?></td>
                            </tr>

                            <tr>
                                <td align="center" style="width: 30%;">MYSQL版本</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['mysql']; ?></td>
                            </tr>
                            <tr>
                                <td align="center" style="width: 30%;">数据库大小</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['mysql_size']; ?></td>
                            </tr>
                            <tr>
                                <td align="center" style="width: 30%;">PHP运行方式</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['run']; ?></td>
                            </tr>
                            <tr>
                                <td align="center" style="width: 30%;">ThinkPHP版本</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['think']; ?></td>
                            </tr>
                            <tr>
                                <td align="center" style="width: 30%;">上传附件限制</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['upload']; ?></td>
                            </tr>
                            <tr>
                                <td align="center" style="width: 30%;">执行时间限制</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['gotime']; ?></td>
                            </tr>

                            <tr>
                                <td align="center" style="width: 30%;">服务器时间</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['ostime']; ?></td>
                            </tr>
                            <tr>
                                <td align="center" style="width: 30%;">北京时间</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['bjtime']; ?></td>
                            </tr>
                            <tr>
                                <td align="center" style="width: 30%;">服务器域名/IP</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['os_do_ip']; ?></td>
                            </tr>
                            <tr>
                                <td align="center" style="width: 30%;">剩余空间</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['kongjian']; ?></td>
                            </tr>
                            <tr>
                                <td align="center" style="width: 30%;">register_globals</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['register_globals']; ?></td>
                            </tr>
                            <tr>
                                <td align="center" style="width: 30%;">magic_quotes_gpc</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['magic_quotes_gpc']; ?></td>
                            </tr>
                            <tr>
                                <td align="center" style="width: 30%;">magic_quotes_runtime</td>
                                <td align="left" style="width: 70%;"><?php echo $vo['magic_quotes_runtime']; ?></td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
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

    get_client_location(function (info) {
        $('#getip').html('你的ip所在地为:' + info.country + info.province + info.city);
    });

    /**
     * 获得ip所在地址
     * @param  {Function} cb [回调函数]
     * @return {[type]}      [description]
     */
    function get_client_location(cb){
        var script = document.createElement("script"),
        s = document.getElementsByTagName("script")[0];
        script.src = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=jsonp";
        s.parentNode.insertBefore(script, s);
        var it = setInterval(
                function(){
                    //console.log(remote_ip_info)
                    if(remote_ip_info){
                        cb(remote_ip_info);
                        remote_ip_info = null;
                         clearInterval(it);
                         it = null;
                    }
                },100);
    } 

   
</script>

</body></html>