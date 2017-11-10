<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"D:\phpStudy\WWW\tp5api\public/../application/tests\view\index\index.html";i:1503625061;s:65:"D:\phpStudy\WWW\tp5api\public/../application/tests\view\base.html";i:1503625061;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <title>模型测试</title>
    

    
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css?v=2">
    <link rel="stylesheet" href="<?php echo url('index/layui', '', false); ?>">
    
    
    

    <script type="text/javascript" src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.bootcss.com/layer/2.4/layer.min.js"></script>
    <script>var Zepto = jQuery</script>

</head>
<body>
<div class="layui-main">
    
    <header>
        <ul class="layui-nav" lay-filter="">
            <?php foreach($menus as $key => $item): ?>
            <li class="layui-nav-item <?php if($key == $currentMenu): ?>layui-this<?php endif; ?>"><a href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </header>
    

    
<div class="layui-main">
    <table class="layui-table">
        <colgroup>
            <col width="300">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th>文件</th>
            <th>名称</th>
            <th>测试方法</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($models as $item): ?>
        <tr>
            <td><?php echo $item['base']['name']; ?></td>
            <td><?php echo $item['base']['comment']; ?></td>
            <td>
                <ul>
                    <?php foreach($item['methods'] as $v): if($v['modifier'] == 'public' && ($v['name'] != 'run')): ?>
                    <li> <a target="_blank" href="?case=<?php echo $item['class']; ?>&mask=<?php echo $v['name']; ?>"><?php echo $v['comment']; ?>: <?php echo $v['name']; ?></a> </li>
                    <?php endif; endforeach; ?>
                </ul>
            </td>
            <td>
                <a target="_blank" href="?case=<?php echo $item['class']; ?>">测试</a>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</div>
</body>




</html>