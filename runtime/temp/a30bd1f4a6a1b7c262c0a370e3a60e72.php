<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\conf\lst.html";i:1510130860;s:71:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\public\top.html";i:1509518630;s:72:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\public\left.html";i:1510026062;}*/ ?>
<!DOCTYPE html>
<html><head>
	    <meta charset="utf-8">
    <title>系统配置</title>

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
                        <a href="#">系统</a>
                    </li>
                                        <li class="active">系统配置</li>
                                        </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
<button type="button" tooltip="添加系统配置" class="btn btn-sm btn-azure btn-addon" onClick="javascript:window.location.href = '<?php echo url('add'); ?>'"> <i class="fa fa-plus"></i> Add
</button>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-body">
                <div class="flip-scroll">
                <form action="" method="post">
                    <table class="table table-bordered table-hover">
                        <thead class="">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">排序</th>
                                <th class="text-center">英文名称</th>
                                <th class="text-center">中文名称</th>
                                <th class="text-center">配置类型</th>
                                <th class="text-center">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($confs) || $confs instanceof \think\Collection || $confs instanceof \think\Paginator): $i = 0; $__LIST__ = $confs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <td align="center" style="width: 10%;"><?php echo $vo['id']; ?></td>
                                <td align="center" style="width: 10%;"> 
                                    <input type="text" style="width: 50%;text-align: center;" name="<?php echo $vo['id']; ?>" value="<?php echo $vo['sort']; ?>">
                                </td>
                                <td align="center" style="width: 10%;"><?php echo $vo['enname']; ?></td>
                                <td align="center" style="width: 10%;"><?php echo $vo['cnname']; ?></td>
                                <td align="center" style="width: 10%;">
                                <?php if($vo['type'] == 1): ?>
                                <span style="color: green;">单行文本</span>
                                <?php elseif($vo['type'] == 2): ?>
                                <span style="color: red;">多行文本</span>
                                <?php elseif($vo['type'] == 3): ?>
                                <span style="color: blue;">单选按钮</span>
                                <?php elseif($vo['type'] == 4): ?>
                                <span style="color: #e500ff;">复选按钮</span>
                                <?php elseif($vo['type'] == 5): ?>
                                <span style="color: #00a1ff;">下拉菜单</span>
                                <?php else: ?>
                                <span style="color: #ff00f2;">未知类型</span>
                                <?php endif; ?>
                                </td>
                                
                                <td align="center" style="width: 20%;">
                                    <a href="<?php echo url('edit',array('id'=>$vo['id'])); ?>" class="btn btn-primary btn-sm shiny">
                                        <i class="fa fa-edit"></i> 编辑
                                    </a>
                                    <a href="#" onClick="warning('确实要删除吗', '<?php echo url('del',array('id'=>$vo['id'])); ?>')" class="btn btn-danger btn-sm shiny">
                                        <i class="fa fa-trash-o"></i> 删除
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?> 
                          <tr>
                                <td></td>
                                <td style="text-align: center;">
                                    <input type="submit" class="btn btn-primary btn-sm shiny" name="" value="排序">
                                </td>
                                <td colspan="5"></td>
                            </tr>                        
                        </tbody>
                    </table>
                     </form>
                </div>
                <div style="padding-top:10px;text-align: center;">
                <?php echo $confs->render(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 声明使用 TagLib -->

<!-- 引入 ueditor 使用的静态资源文件 type:编辑器名称，path:编辑器静态资源存放路径 -->
<!-- 配置文件 --><script type="text/javascript" src="http://tp5api.com/static/admin/ueditor/ueditor.config.js"></script><!-- 编辑器源码文件 --><script type="text/javascript" src="http://tp5api.com/static/admin/ueditor/ueditor.all.min.js"></script>
<!-- 在需要使用 ueditor 编辑器的地方插入 -->
<!-- 加载编辑器的容器 --><script id="container" name="content" type="text/plain" style=""></script><!-- 实例化编辑器 --><script type="text/javascript">var ue_container = UE.getEditor('container');</script>

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
    


</body></html>