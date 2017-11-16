<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\conf\conf.html";i:1510535848;s:71:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\public\top.html";i:1509518630;s:72:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\public\left.html";i:1510292249;}*/ ?>
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
                        <a href="#">系统</a>
                    </li>
                                        <li class="active">系统配置</li>
                                        </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
<button type="button" tooltip="添加系统配置" class="btn btn-sm btn-azure btn-addon"> 网站配置
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
                                <th class="text-center">配置名称</th>
                                <th class="text-center">配置值</th>
                        
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <td align="center" style="width: 20%;"><?php echo $vo['cnname']; ?></td>
                                <td align="left" style="width: 80%;"> 
                                    <!-- 单行文本 -->
                                    <?php if($vo['type'] == 1): ?>
                                    <input class="form-control" placeholder="" name="<?php echo $vo['enname']; ?>"  type="text" value="<?php echo $vo['value']; ?>">
                                    <!-- 多行文本 -->
                                    <?php elseif($vo['type'] == 2): ?>
                                        <textarea class="form-control" name="<?php echo $vo['enname']; ?>"><?php echo $vo['value']; ?></textarea>
                                    <!-- 单选 -->
                                    <?php elseif($vo['type'] == 3): if(is_array(explode(',',trim($vo['values']))) || explode(',',trim($vo['values'])) instanceof \think\Collection || explode(',',trim($vo['values'])) instanceof \think\Paginator): $i = 0; $__LIST__ = explode(',',trim($vo['values']));if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                        <div style="float: left;padding-right: 20px;">
                                            <label>
                                                <input name="<?php echo $vo['enname']; ?>" value="<?php echo $v; ?>" type="radio" <?php if($vo['value'] == $v): ?>checked<?php endif; ?>>
                                                <span class="text"><?php echo $v; ?></span>
                                            </label>
                                        </div>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    <!-- 多选 -->
                                    <?php elseif($vo['type'] == 4): ?>
                                        <div class="checkbox" style="">
                                            <label>
                                                <input name="<?php echo $vo['enname']; ?>" type="checkbox" value="<?php echo $vo['values']; ?>" <?php if($vo['value'] == $vo['values']): ?>checked<?php endif; ?> >
                                                <span class="text"><?php echo $vo['values']; ?></span>
                                            </label>
                                        </div>
                                    <!-- 下拉菜单 -->
                                    <?php elseif($vo['type'] == 5): ?>
                                        <select name="<?php echo $vo['enname']; ?>">
                                            <?php if(is_array(explode(',',trim($vo['values']))) || explode(',',trim($vo['values'])) instanceof \think\Collection || explode(',',trim($vo['values'])) instanceof \think\Paginator): $k = 0; $__LIST__ = explode(',',trim($vo['values']));if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
                                                <option value="<?php echo $v; ?>" <?php if($vo['value'] == $v): ?>selected="selected"<?php endif; ?>><?php echo $v; ?></option>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                    <?php endif; ?>
                                   
                                </td>
                            </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?> 
                          <tr >
                                <td  colspan='2' style="text-align: center;">
                                    <input type="submit" style="width: 500px;height: 50px;font-size: 20px;" class="btn btn-primary btn-sm shiny" name="" value="提交修改">
                                </td>
                            </tr>                        
                        </tbody>
                    </table>
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
    


</body></html>