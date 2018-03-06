<?php
//开启调试模式
define('APP_DEBUG',TRUE);
//定义应用的存储地址
define('APP_PATH','./Application/');
//添加编码信息
header('Content-type:text/html;Charset=utf-8');
//2.载入TP框架的入口文件
include './ThinkPHP/ThinkPHP.php';
?>