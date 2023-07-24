<?php
require_once "../vendor/autoload.php";
$config=require("config/wechat.php");
//\iboxs\wechat\Applet::add();
\iboxs\wechat\Wechat::miniProgram($config['official'])->sec->msg_sec_check('aaaa');