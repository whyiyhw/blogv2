<?php
return array(

    'SHOW_PAGE_TRACE'      => true,//开启 开发者工具
    'URL_MODEL'            => 2,
    //增加自定义模版替换
    'TMPL_PARSE_STRING'      => array(
        '__PUBLIC_ADMIN__'   => '/Public/Admin',
        '__PUBLIC_HOME__'    => '/Public/Home',
        '__PUBLIC_UEDITOR__' => '/Public/Ueditor',
        '__PUBLIC_HUI__' => '/Public/Hui',
    ),
    //数据库配置列表
    'DB_TYPE'              => 'mysql',//数据库类型
    'DB_HOST'              => '47.93.234.180',//服务器地址
    'DB_NAME'              => 'bloog',//表名
    'DB_USER'              => 'root',//用户名
    'DB_PWD'               => 'xueyi',//密码
    'DB_PORT'              => '3306',//端口
    'DB_PREFIX'            => 'bl_',//数据库表前缀
);