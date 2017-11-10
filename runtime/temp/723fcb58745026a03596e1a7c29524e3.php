<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:73:"D:\phpStudy\WWW\tp5api\public/../application/tests\view\index\result.html";i:1503625061;s:65:"D:\phpStudy\WWW\tp5api\public/../application/tests\view\base.html";i:1503625061;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <title>模型测试</title>
    

    
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css?v=2">
    <link rel="stylesheet" href="<?php echo url('index/layui', '', false); ?>">
    
    
<style>
    .result-success{
        background: #5FB878;
        color: #fff;
    }
    .result-error{
        background: #FF5722;
        color: #fff;
    }

</style>


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
            <col width="120">
            <col>
            <col>
            <col width="140">
        </colgroup>
        <thead>
        <tr>
            <th>结果</th>
            <th>测试项目</th>
            <th>消息</th>
            <th>耗时</th>
            <th>数据</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($result['data'] as $item): ?>
        <tr>
            <td class="result-<?php echo $item['type']; ?>"><?php echo $item['type']; ?></td>
            <td><?php echo $item['comment']; ?></td>
            <td><?php echo $item['msg']; ?></td>
            <td><?php echo $item['time']; ?></td>
            <td>
                <?php if($item['data']): ?>
                <pre class="layui-code"><?php print_r($item['data']) ?></pre>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>

</div>
</body>


<script>
    layui.use(['element', 'code'], function () {
        var element = layui.element();
        layui.code();
    });
</script>

</html>