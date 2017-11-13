<?php
return [
    'start_using'   =>  'off',  //on 开 off关闭
    'doc_dir'       => 'word',  //文档保存目录默认
    'api_v1.0_list'=> [			//接口
       'app\word\controller\Demo', //接口目录地址
    ],
    //版本更新
    'v1.0'          => [   
        ['2017-11-10 09:47', '注册用户接口', '新增site_id', '墨竹']
    ],
];