<?php

use iboxs\wechat\Wechat;

require_once "../vendor/autoload.php";
$config=require("config/wechat.php");
$config=$config['official'];
$code=$_GET['code']??null;
if($code==null){
    echo '非法访问';
    return;
}
$result= Wechat::officialAccount($config)->web->code2token($code);
$accessToken=$result['access_token'];
$openID=$result['openid'];
$result=Wechat::officialAccount($config)->web->userinfo($accessToken,$openID);
dd($result);