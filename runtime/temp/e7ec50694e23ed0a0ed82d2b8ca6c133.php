<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\funs\excel.html";i:1509683839;s:71:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\public\top.html";i:1509518630;s:72:"D:\phpStudy\WWW\tp5api\public/../application/admin\view\public\left.html";i:1510277372;}*/ ?>
<!DOCTYPE html>
<html><head>
	    <meta charset="utf-8">
    <title>excel</title>

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
                        <a href="<?php echo url('Index/index'); ?>">系统</a>
                    </li>
                                        <li class="active">excel</li>
                                        </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
                 <div class="widget-body bordered-left bordered-warning">
                    <form class="form-inline" role="form" action="" method="post" enctype="multipart/form-data" id="uploadForm">
                        <input type="hidden" name="file_name" value="" id="file_name">
                        <input type="file" name="file" id="file" value="" onchange="select_file_excel()" style="display: none;">
                        <div class="form-group">
                            <input type="button" class="btn btn-success" onclick="file_excel()" value="点击开始上传excel">
                        </div>
                        <div class="form-group">
                            <input type="button" class="btn btn-success" onclick="file_down(1)" value="ajax下载csv">
                        </div>
                        <div class="form-group">
                            <input type="button" class="btn btn-success" onclick="file_down(2)" value="ajax下载xls">
                        </div>
                        <div class="form-group">
                            <input type="button" class="btn btn-success" onclick="file_down(3)" value="ajax下载xlsx">
                        </div>
                    </form>
                </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="widget">
                                <div class="widget-body">
                                    <div class="flip-scroll">
                                        <form action="" method="post"> 
                                        <table class="table table-bordered table-hover">
                                           
                                            <tbody id='exceltext'>
                                                
                                              
                                            </tbody>
                                        </table>
                                    </form>
                                    </div>
                                    <div style="padding-top:10px;text-align: center;">
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

    //上传文件*****************************************
     //导入excel
    function file_excel(){
       $("#file").click();
    }



    //选择图片
    function select_file_excel() {

        $.ajax({
            url: "<?php echo url('funs/doupload'); ?>",
            type: 'POST',
            cache: false,
            data: new FormData($('#uploadForm')[0]),
            dataType:'json',
            processData: false,
            contentType: false,
            success:function(json){
                console.log(json)
                //返回提示信息
                if(json.code == 1001){
                    gdata = {};
                    gdata = json.data;
                    var res = json.data.data;
                    var text = '';
                    //res为三维数组
                    for(var i=0;i<res.length;i++){
                        for(var j=0;j<res[i].length;j++){
                            text += '<tr><td align="center">'+res[i][j][0]+'</td><td align="center">'+res[i][j][1]+'</td><td align="center">'+res[i][j][2]+'</td><td align="center">'+res[i][j][3]+'</td><td align="center">'+res[i][j][4]+'</td><td align="center">'+res[i][j][5]+'</td><td align="center">'+res[i][j][6]+'</td>';
                        }
                    }
                    $('#exceltext').append(text);
                }
                if(json.code == 2001){
                    alert(json.msg);
                }
            }
        });
    }



    //下载excel
    function file_down(loadtype){
        $.ajax({
            url: "<?php echo url('funs/dodownload'); ?>",
            type: 'POST',
            cache: false,
            data: {arr:gdata,tp:loadtype},
            dataType:'json',
            success:function(res){
                //console.log(res)
                if(res.code == 1001){
                    window.location.href='/'+res.data.data;
                    //删除源文件
                    delfile(res.data.data);
                }
                if(res.code ==2001){
                    alert(res.msg);
                }

            }
        });
    }


     //删除事件,live高版本已经废除，用on
    // $(document).live(function(){
    // })
    function delfile(fileurl){
        //执行删除
        $.ajax({
            url: "<?php echo url('funs/delfile'); ?>",
            type: 'POST',
            data: {src:fileurl},
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
    }
    </script>

</body></html>