<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [

    // 视图输出字符串内容替换
    'view_replace_str'       => [
    	'__PUBLIC__' => '/',
        '__ADMIN__'  => '/static/admin',
        '__STATIC__' => '/static',
    ],
     //模板标签配置
     // 'template'               => [
     //         // 模板引擎类型 支持 php think 支持扩展
     //         'type'         => 'Think',
     //         // 模板路径
     //         'view_path'    => '',
     //         // 模板后缀
     //         'view_suffix'  => '.html',
     //         // 预先加载的标签库
     //         'taglib_pre_load'     =>    'Editor',
          
     //     ],
];