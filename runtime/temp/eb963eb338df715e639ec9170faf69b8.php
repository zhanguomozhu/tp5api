<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:76:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\sfun\uploadfile.html";i:1509682518;s:71:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\public\top.html";i:1509518630;s:72:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\public\left.html";i:1510214119;}*/ ?>
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
                    <?php echo is_array($leftMenus);?>
                    <!--Dashboard-->
                    <?php if(isset($leftMenus) && isset($rules)): if(is_array($leftMenus) || $leftMenus instanceof \think\Collection || $leftMenus instanceof \think\Paginator): $i = 0; $__LIST__ = $leftMenus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if(in_array($vo['id'],$rules) == true){?>
                        <li>
                            <a href="<?php echo url($vo['name']); ?>" class="menu-dropdown">
                                <i class="menu-icon fa <?php echo $vo['pid']; ?>"></i>
                                <span class="menu-text"><?php echo $vo['title']; ?></span>
                                <i class="menu-expand"></i>
                            </a>
                            <?php if(isset($vo['son'])): ?>
                            <ul class="submenu">
                                
                                <?php if(is_array($vo['son']) || $vo['son'] instanceof \think\Collection || $vo['son'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                <li>
                                    <a href="<?php echo url($v['name']); ?>">
                                        <i class="menu-icon fa <?php echo $v['pid']; ?>"></i>
                                        <span class="menu-text"><?php echo $v['title']; ?></span>
                                        <i class="menu-expand"></i>
                                    </a>
                                </li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                
                            </ul> 
                            <?php endif; ?>
                        </li>
                    <?php } endforeach; endif; else: echo "" ;endif; endif; ?>





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
                    <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data" id="uploadForm">
                       <div class="form-group">
                             <input type="file" name="img" id="file" value="" onchange="select_file_excel()" style="display: none;">
                             <div align="left">
                                <label for="username" class="col-sm-2 control-label no-padding-right">上传图片</label>
                                <div class="col-sm-1">
                                    <input type="button" class="btn btn-success" onclick="file_excel()" value="点击开始上传">
                                </div>
                                <div class="col-sm-4">
                                <p class="red img1"></p>
                            </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="username" class="col-sm-2 control-label no-padding-right">预览图片</label>
                            <div class="col-sm-10">
                                <div style="height: 100%;" id="img1">
                                </div>
                            </div>
                       </div>


                       
                    </form>
                </div>
                <div id="horizontal-form" style="margin-top: 100px;">
                     <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data" id="uploadForm1" >
                       <div class="form-group">
                             <input type="file" name="file" id="file1" value="" onchange="select_file_excel1()" style="display: none;">
                             <div align="left">
                                <label for="username" class="col-sm-2 control-label no-padding-right">上传文件</label>
                                <div class="col-sm-1">
                                    <input type="button" class="btn btn-success" onclick="file_excel1()" value="点击开始上传">
                                </div>
                                <div class="col-sm-4">
                                <p class="red file1"></p>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>


            <div id="horizontal-form" style="height: 100px;">
                <div class="form-group">
                        <div class="col-sm-1">
                        </div>
                        <div class="col-sm-6">
                           <ul id="file2">
                               
                           </ul>
                        </div>
                </div>
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
    // var countdown=10; 
    // function settime(obj) { 
    //     if (countdown == 0) { 
    //         obj.removeAttribute("disabled");    
    //         obj.value="点击发送邮件"; 
    //         countdown = 10; 
    //         return;
    //     } else { 
    //         obj.setAttribute("disabled", true); 
    //         obj.value="重新发送(" + countdown + ")"; 
    //         countdown--; 
    //     } 
    // setTimeout(function() { 
    //     settime(obj) }
    //     ,1000) 
    // }


    //上传图片*****************************************
    //导入excel
    function file_excel(){
       $("#file").click();
    }

    //选择图片
    function select_file_excel() {

        $.ajax({
            url: "<?php echo url('sfun/douploadimg'); ?>",
            type: 'POST',
            cache: false,
            data: new FormData($('#uploadForm')[0]),
            dataType:'json',
            processData: false,
            contentType: false,
            success:function(json){

                //返回提示信息
                if(json.code == 1001){
                    $('.img1').removeClass('red').addClass('green').html(json.msg);
                    var str = "<img class='uploadimg' style='height:100px;margin:5px 5px;float:left;' src='__PUBLIC__"+json.data.data+"' title='点击删除图片'>";
                    $('#img1').append(str);
                }
                if(json.code == 2001){
                    $('.img1').html(json.msg);
                }
            }
        });
    }

    //img点击删除事件,live高版本已经废除，用on
    // $(document).live(function(){
    // })
    $(document).on("click",'.uploadimg',function(){
        //提示
        if(confirm('确认删除吗？')){
            //执行删除
            $.ajax({
                url: "<?php echo url('sfun/delfile'); ?>",
                type: 'POST',
                data: {src:$(this).attr('src')},
                dataType:'json',
                success:function(json){
                    console.log(json)
                    //返回提示信息
                    if(json.code == 1001){
                        
                        $('.img1').removeClass('red').addClass('green').html(json.msg);
                    }
                    if(json.code == 2001){
                        $('.img1').addClass('red').html(json.msg);
                    }
                }
            });
            //移除节点
            $(this).remove();
        }
        
    });

    //上传文件*****************************************
     //导入excel
    function file_excel1(){
       $("#file1").click();
    }

    //选择图片
    function select_file_excel1() {

        $.ajax({
            url: "<?php echo url('sfun/douploadfile'); ?>",
            type: 'POST',
            cache: false,
            data: new FormData($('#uploadForm1')[0]),
            dataType:'json',
            processData: false,
            contentType: false,
            success:function(json){
                console.log(json)
                //返回提示信息
                if(json.code == 1001){
                    $('.file1').removeClass('red').addClass('green').html(json.msg);
                    var filetext = "<li class='uploadimg' src='"+json.data.data+"'>"+json.data.data+"</li>";
                    $('#file2').append(filetext);
                }
                if(json.code == 2001){
                    $('.file1').html(json.msg);
                }
            }
        });
    }

   
    </script>

</body></html>