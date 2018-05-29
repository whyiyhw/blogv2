<?php

$http = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';

return [
    'admin_base_path' => $http . $_SERVER["HTTP_HOST"] . '/static/admin/',
    'admin_img_path' => $http . $_SERVER["HTTP_HOST"] . '/',
    'xin_lang_ip_api' => 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=',//新浪ip地址API
];