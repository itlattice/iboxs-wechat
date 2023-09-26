<?php

use iboxs\wechat\Wechat;
$config=require("config/wechat.php");
file_put_contents('../tmp/log.txt',json_encode($_GET));
file_put_contents('../tmp/log.txt',file_get_contents('php://input'),FILE_APPEND);
require_once "../vendor/autoload.php";
return Wechat::officialAccount($config['official'])->handle(function(){
    return '你好啊';
});
//消息开始处理