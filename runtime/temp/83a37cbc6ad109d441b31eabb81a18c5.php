<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"D:\phpStudy\WWW\tp5api\public/../application/tests\view\apis\index.html";i:1503625061;s:65:"D:\phpStudy\WWW\tp5api\public/../application/tests\view\base.html";i:1503625061;}*/ ?>
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
    

    
<style>
    .result-success{
        background: #5FB878;
        color: #fff;
    }
    .result-error{
        background: #FF5722;
        color: #fff;
    }
    .api-data-json{
        width: 240px;
        height:16px;
        overflow: hidden;
    }
    .lay-code-show{
        margin: 5px;
        padding: 5px;
    }
    .fields-label .label-success{margin-right: 5px; display: inline-block;}
</style>


<table class="layui-table">
    <colgroup>
        <col width="50">
        <col width="150">
        <col width="70">
        <col width="140">
        <col>
        <col width="300">
    </colgroup>
    <thead>
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>method</th>
        <th>参数</th>
        <th>返回字段</th>
        <th>示例 </th>
        <th>操作 <button class="layui-btn api-save">增加api</button></th>
    </tr>
    </thead>
    <tbody>

    <?php foreach($apis as $key => $item): ?>
    <tr>
        <td><?php echo $item['id']; ?></td>
        <td>
            <span class="api-desc-tip" data-title="<?php echo str_replace('"', '', $item['title']); ?>" data-desc="<?php echo str_replace('"', '', $item['desc']); ?>"><?php echo $item->name; ?></span>
        </td>
        <td><?php echo $item['method']; ?></td>
        <td>
            <?php echo $item['args_se_br']; ?>
        </td>
        <td class="fields-label">
            <?php if($item['fields_show']): foreach($item['fields_show'] as $k => $v): ?>
            <span class="label label-success">  <?php echo $v['field']; ?> : <?php echo $v['config']['title']; ?></span>
            <?php endforeach; endif; ?>
        </td>
        <td>
            <?php if($item['result_show']){ ?>
            <div class="api-data-json"><?php echo json_encode($item['result_show']); ?></div>
            <?php } ?>
        </td>
        <td>
            <a href="javascript:alert('安全起见，暂时不允许删除，请联系数据库管理员')">删除</a>
            <a href="javascript:void(0)" class="api-save" data-id="<?php echo $item['id']; ?>">修改</a>
            <a href="<?php echo url('mock', ['name' => $item->name]); ?>" target="_blank">访问</a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script>

    $(function(){
        var url = "<?php echo url('apisSave'); ?>";
        $('.api-save').on('click', function(){
            var id = $(this).data('id');
            var editUrl = url;
            if(id){
                editUrl = url + '&id=' + id
            }

            layer.open({
                type: 2,
                title: 'api操作',
                shadeClose: true,
                shade: 0.8,
                area: ['750px', '70%'],
                content: editUrl
            });
        })

        //演示数据
        $('.api-data-json').on('click', function(){
            var data = $(this).html();
            var result = JSON.stringify(JSON.parse(data), null, 4);
            layer.open({
                type: 1,
                title: '结果演示',
                area: ['380px', '50%'],
                content: '<pre class="lay-code-show">' + result + '</pre>'
            });
        })

        //tip
        $(".api-desc-tip").on('click', function(){
            var _this = $(this);
            var tipHtml = _this.data('title') + '<br/>';
            tipHtml += _this.data('desc');
            layer.tips(tipHtml, _this, {
                tips: [4, '#3595CC'],
                tipsMore: true
            });
        })
    })
</script>

</div>
</body>




</html>