<?php
require_once '../vendor/autoload.php';
use iboxs\wechat\Http;

// $result=Http::Client('http://post.itgz8.com/auth/test')->header(['aa:55a'])->get(['a'=>'s'],true,$status,$header);  //发起一个get请求
// $result=Http::Client('http://post.itgz8.com/auth/testfile')->postFile(['a'=>'n'],'G:\\1.jpg','file',true,$status,$header);  //发起一个get请求
// var_dump($result);//请求结果
// var_dump($status);//状态码
// var_dump($header);//响应头