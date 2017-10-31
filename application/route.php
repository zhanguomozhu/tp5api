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
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    // '[upload]' => [
    //     'show_images/:md5/:size' => [
    //         'system/file/showPicture', ['method' => 'get'], ['size' => '\d+_\d+', 'md5' => '(\w+)'], ['ext' => ['jpg', 'png']],
    //     ],
    //     'down_images/:md5/[:size]' => [
    //         'system/file/downloadPicture', ['method' => 'get'], ['size' => '\d+_\d+', 'md5' => '(\w+)'], ['ext' => ['jpg', 'png']],
    //     ],
    //     'down_files/:md5' => [
    //         'system/file/downloadFiles', ['method' => 'get'], [ 'md5' => '(\w+)'], ['ext' => ['jpg', 'png']],
    //     ],

    // ],
    // // return [
    // '__pattern__' => [
    //     'id' => '\d+',
    //     'cityid' => '\d+',
    //     'name'=>'[A-Za-z0-9]+',
    // ],
    // //信息查询接口
    // "[search]"=>[
    //     'help'=>['api/search/superHelp'],
    //     '/:name'=>['api/search/superSearchByName?name=:name'],
    // ],
    // //获取字段参数信息接口
    // "[getOptions]"=>[
    //     'help'=>['api/search/superHelp'],
    //     '/:name'=>['api/search/getSearchOptionsByName?name=:name'],
    // ],
    // //获取简单字段信息接口
    // "[getField]"=>[
    //     'help'=>['api/search/superHelp'],
    //     '/:name'=>['api/search/getSearchFieldByName?name=:name'],
    // ],
    // //详情接口
    // "[detail]"=>[
    //     'help'=>['api/search/superHelp'],
    //     'info/:id'=>['api/search/superInfo'],
    //     'mini/:id'=>['api/search/superInfoMini'],
    // ],
    // // 发布接口
    // "[publish]"=>[
    //     'help'=>['api/search/superHelp'],
    //     '/:name'=>['api/search/superPublishByName?name=:name'],
    // ],

    // // 获取发布字段
    // "[getPublishField]"=>[
    //     'help'=>['api/search/superHelp'],
    //     '/:name'=>['api/search/superPublishFieldByName?name=:name'],
    // ],
    // // 获取子栏目接口
    // "[childCategoryList]"=>[
    //     'help'=>['api/search/superHelp'],
    //     '/:name'=>['api/search/superChildCategoryListByName?name=:name'],
    // ],
    // '[system]'=>[
    //     'clearCache'=>'api/search/clearCache',
    // ],

];
