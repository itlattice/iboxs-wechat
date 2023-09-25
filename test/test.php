<?php
require_once "../vendor/autoload.php";
$config=require("config/wechat.php");
//\iboxs\wechat\Applet::add();
$result=\iboxs\wechat\Wechat::miniProgram($config['official'])->sec->msg_sec_check('aaaa',1,'5555');
dd($result);