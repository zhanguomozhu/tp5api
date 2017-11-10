<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:73:"D:\phpStudy\WWW\tp5api\public/../application/tests\view\fields\index.html";i:1503625061;s:65:"D:\phpStudy\WWW\tp5api\public/../application/tests\view\base.html";i:1503625061;}*/ ?>
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
    

    

<table class="layui-table">
    <colgroup>
        <col width="80">
        <col width="200">
        <col>
        <col width="140">
        <col>
        <col width="160">
    </colgroup>
    <thead>
    <tr>
        <th>ID</th>
        <th>字段 </th>
        <th>名称</th>
        <th>类型</th>
        <th>示例值</th>
        <th>操作 <button id="add-field" class="layui-btn">增加字段</button></th>
    </tr>
    </thead>
    <tbody>

    <?php foreach($fields as $key => $item): ?>
    <tr>
        <?php foreach($item->toArray() as $k => $v): if($k == 'id'): ?>
        <td><?php echo $v; ?></td>
        <?php else: ?>
        <td><span ondblclick="ShowElements(this, <?php echo $item->id; ?>, '<?php echo $k; ?>')"><?php echo $v; ?></span></td>
        <?php endif; endforeach; ?>
        <th><a href="javascript:alert('安全起见，暂时不允许删除，请联系数据库管理员')">删除</a></th>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div id="add-field-cnt" style="display: none;">
    <div style="padding: 20px" id="field-add-form">
        <form action="" name="" method="post" target="" enctype="multipart/form-data">
            <input name="do" value="add" type="hidden" class="form-control" />
            <table width="100%" cellspacing="0" cellpadding="4" class="table formTable">
                <tr>
                    <th align="right">字段名</th>
                    <td ><input name="name" value="" size="20" maxlength="255" class="form-control" type="text" /></td>
                </tr>
                <tr>
                    <th align="right">标题</th>
                    <td ><input name="title" value="" size="20" maxlength="255" class="form-control" type="text" /></td>
                </tr>
                <tr>
                    <th align="right">类型</th>
                    <td ><input name="type" value="" size="20" maxlength="255" class="form-control" type="text" /></td>
                </tr>
                <tr>
                    <th align="right">mock值</th>
                    <td ><input name="value" value="" size="20" maxlength="255" class="form-control" type="text" /></td>
                </tr>
                <tr class="submitRow">
                    <th>&nbsp;</th>
                    <td><input value="增加" class="btn btn-w-m btn-primary" type="submit"id="field-add-btn" />  </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<script>
    var url = "<?php echo url('index'); ?>";
    function ShowElements(element, id, key) {
        var oldhtml = element.innerHTML;
        //创建新的input元素
        var newobj = document.createElement('input');
        //为新增元素添加类型
        newobj.type = 'text';
        //为新增元素添加value值
        newobj.value = oldhtml;
        //为新增元素添加光标离开事件
        newobj.onblur = function() {
            if(this.value == oldhtml){
                element.innerHTML = oldhtml;
            } else {
                element.innerHTML = this.value;
                var postValue = this.value;
                $.post(url, {do: 'modify', id: id, key: key, value: postValue}, function (rs) {
                    if(rs.code !=  200){
                        element.innerHTML = oldhtml;
                    }
                }, 'json')
            }
            //当触发时判断新增元素值是否为空，为空则不修改，并返回原有值
        }
        //设置该标签的子节点为空
        element.innerHTML = '';
        //添加该标签的子节点，input对象
        element.appendChild(newobj);
        //设置选择文本的内容或设置光标位置（两个参数：start,end；start为开始位置，end为结束位置；如果开始位置和结束位置相同则就是光标位置）
        newobj.setSelectionRange(0, oldhtml.length);
        //设置获得光标
        newobj.focus();

    }

    $(function () {
        $("#add-field").on('click', function(){
            layer.open({
                type: 1,
                shade: false,
                title: false, //不显示标题
                content: $('#add-field-cnt')
            });
        })

        $("#field-add-btn").on('click', function () {
            $.ajax({
                type: 'post',
                url: url,
                data: $("#field-add-form form").serialize(),
                success: function(data) {
                    if(data.code == 200){
                        layer.msg('操作成功', {icon: 1}, function () {
                            window.location.href = window.location.href;
                        });
                    } else {
                        layer.msg(data.message, {icon: 2});
                    }
                    // your code
                }
            });
            return false;
        })
    })
</script>

</div>
</body>




</html>