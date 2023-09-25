<?php

use iboxs\wechat\Wechat;
$config=require("config/wechat.php");
file_put_contents('../tmp/log.txt',json_encode($_GET));
require_once "../vendor/autoload.php";
$result=Wechat::officialAccount($config['official'])->sign->checkSignature();
echo $_GET['echostr'];