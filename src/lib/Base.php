<?php

namespace iboxs\wechat\lib;

use iboxs\redis\Redis;
use iboxs\wechat\lib\traitlib\Http;

class Base
{
    use Http;

    public $config=[
        'appid'=>'',
        'appsecret'=>''
    ];

    protected $host="https://api.weixin.qq.com/";

    protected $accessToken='';

    public function __construct($config=[])
    {
        $this->config['appid']=$config['appid']??die('APPID不可为空');
        $this->config['appsecret']=$config['appsecret']??die('appSecret is Empty');
    }

    public function getToken($cache=true){
        $appid=$this->config['appid'];
        $accessToken=Redis::basic()->get('iboxs:wechat:accesstoken:'.$appid);
        if($accessToken!=null && $cache==true){
            $this->accessToken=$accessToken;
            return $accessToken;
        }
        $secret=$this->config['appsecret'];
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret=".$secret;
        $result=$this->Get($url);
        $code=$result['errcode']??-1;
        if($code!=0){
            die('配置信息错误');
        }
        $accessToken=$result['access_token'];
        $time=$result['expires_in'];
        $this->accessToken=$accessToken;
        Redis::basic()->set('iboxs:wechat:accesstoken:'.$appid,$accessToken,$time-60);
        return $accessToken;
    }
}