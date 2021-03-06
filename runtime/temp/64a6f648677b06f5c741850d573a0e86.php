<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:74:"D:\phpStudy\WWW\tp5api\public/../application/tests\view\apis\apissave.html";i:1503625061;s:65:"D:\phpStudy\WWW\tp5api\public/../application/tests\view\base.html";i:1503625061;}*/ ?>
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
    


    
<style>
    .layui-main {
        width: auto
    }

    .autocomplete-suggestions {
        border: 1px solid #999;
        background: #FFF;
        overflow: auto;
    }

    .autocomplete-suggestion {
        padding: 2px 5px;
        white-space: nowrap;
        overflow: hidden;
    }

    .autocomplete-selected {
        background: #F0F0F0;
    }

    .autocomplete-suggestions strong {
        font-weight: normal;
        color: #3399FF;
    }

    .autocomplete-group {
        padding: 2px 5px;
    }

    .autocomplete-group strong {
        display: block;
        border-bottom: 1px solid #000;
    }

    #fields_se {
        width: 200px;
    }

    .fields_se_item {
        margin: 5px 5px 5px 0;

    }
</style>

<div style="padding: 20px" id="api-add-form">

    <form action="" name="" method="post" target="" enctype="multipart/form-data">
        <input name="id" value="<?php echo !empty($info)?$info['id'] : null; ?>" class="form-control" type="hidden">
        <table class="table formTable" width="100%" cellspacing="0" cellpadding="4">
            <tbody>
            <tr>
                <th align="right">name</th>
                <td><input name="name" value="<?php echo !empty($info)?$info->name : null; ?>" size="20" maxlength="255" class="form-control"
                           type="text">
                </td>
            </tr>
            <tr>
                <th align="right">title</th>
                <td><input name="title" value="<?php echo !empty($info)?$info['title'] : null; ?>" size="20" maxlength="255"
                           class="form-control" type="text"></td>
            </tr>
            <tr>
                <th align="right">请求类型</th>
                <td>
                    <span><input name="method" id="method0" value="get" type="radio" <?php if($info && ($info['method']=='get')): ?> checked="checked" <?php endif; ?>><label for="method0">get </label></span>
                    <span><input name="method" id="method1" value="post" type="radio" <?php if($info && ($info['method']=='post')): ?> checked="checked" <?php endif; ?>><label for="method1">post</label></span>
                </td>
            </tr>
            <tr>
                <th align="right">简介</th>
                <td><input name="desc" value="<?php echo !empty($info)?$info['desc'] : null; ?>" size="20" maxlength="255" class="form-control" type="text"></td>
            </tr>
            <tr>
                <th align="right">参数</th>
                <td><textarea name="args_se" rows="4" cols="40" maxlength="1000" class="form-control"><?php echo !empty($info)?$info['args_se'] : null; ?></textarea>
                </td>
            </tr>
            <tr>
                <th align="right">返回类型</th>
                <td>
                    <span><input name="return_type" id="return_type0" value="row" type="radio" <?php if($info && ($info['return_type']=='row')): ?> checked="checked" <?php endif; ?>><label for="method0">单条 </label></span>
                    <span><input name="return_type" id="return_type1" value="list" type="radio" <?php if($info && ($info['return_type']=='row')): ?> checked="checked" <?php endif; ?>><label for="return_type1">列表</label></span>
                    <span><input name="return_type" id="return_type2" value="search" type="radio" <?php if($info && ($info['return_type']=='search')): ?> checked="checked" <?php endif; ?>><label for="return_type2">列表带分页</label></span>
                    <span><input name="return_type" id="return_type3" value="do" type="radio" <?php if($info && ($info['return_type']=='do')): ?> checked="checked" <?php endif; ?>><label for="return_type3">操作结果</label></span>
                </td>
            </tr>
            <tr>
                <th align="right">返回字段</th>
                <td>
                    <input value="" size="20" maxlength="255" class="form-control" id="fields_se" style="display:inline-block" autocomplete="off" type="text">
                    <div id="fields_se_cnt">
                    <?php if($info && $info['fields_se']): foreach($info['fields_array'] as $item): ?>
                        <span class="layui-btn layui-btn-primary layui-btn-small fields_se_item" id="fields_se_item_<?php echo $item; ?>"><input name="fields_se[]" value="<?php echo $item; ?>" type="hidden"><?php echo $item; ?><i class="layui-icon"> x </i></span>
                        <?php endforeach; endif; ?>
                    </div>
                </td>
            </tr>
            <tr class="submitRow">
                <th>&nbsp;</th>
                <td><input value="保存" class="btn btn-w-m btn-primary" id="api-add-btn" type="submit"></td>
            </tr>
            </tbody>
        </table>
    </form>

</div>

<script src="//cdn.bootcss.com/jquery.devbridge-autocomplete/1.4.1/jquery.autocomplete.min.js"></script>
<script>
    /*var countries = [
     { value: 'Andorra', data: 'AD' },
     // ...
     { value: 'Zimbabwe', data: 'ZZ' }
     ];*/
    var options = {
//            lookup: countries,
        serviceUrl: "<?php echo url('fieldsJson'); ?>",
        onSelect: function (suggestion) {
            var value = suggestion.value;
            var id = 'fields_se_item_' + value;
            if ($("#" + id).length > 0) {
                return true;
            }
            var html = "<span class=\"layui-btn layui-btn-primary layui-btn-small fields_se_item\" id='" + id + "'><input type='hidden' name='fields_se[]' value='" + value + "'>" + value + "<i class=\"layui-icon\"> x </i></span>"
            $("#fields_se_cnt").append(html);
            $("#fields_se").val('')

            $("#" + id).children('i').on('click', function () {
                $(this).parent().remove();
            })
        }
    };
    $(".fields_se_item").children('i').on('click', function () {
        $(this).parent().remove();
    })
    $("#fields_se").autocomplete(options);

    //保存
    var url = "<?php echo url('apisSave'); ?>";
    $("#api-add-btn").on('click', function () {
        $.ajax({
            type: 'post',
            url: url,
            data: $("#api-add-form form").serialize(),
            success: function (data) {
                if (data.code == 200) {
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
</script>


</div>
</body>




</html>