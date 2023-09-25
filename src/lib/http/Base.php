<?php

namespace iboxs\wechat\lib\http;

use iboxs\wechat\lib\Cache;
use iboxs\wechat\lib\Format;
use iboxs\wechat\lib\utils\Http;

class Base
{
    use Http;
    protected static $config;
    public function setConfig($config){
        self::$config=$config;
    }
    public $host="https://api.weixin.qq.com/";

    public function getToken($refresh=false){
        if(!isset(self::$config['appid'])){
            throw new \Exception('APPID未配置');
        }
        if(!isset(self::$config['secret'])){
            throw new \Exception('SECRET未配置');
        }
        $data=[
            'grant_type'=>'client_credential',
            'appid'=>self::$config['appid'],
            'secret'=>self::$config['secret'],
            'force_refresh'=>false
        ];
        $url=$this->host.'cgi-bin/stable_token';
        $json=$this->PostJson($url,json_encode($data),Format::FMT_JSON);
        if(isset($json['errcode'])&&$json['errcode']!=0){
            throw new \Exception('微信Token获取请求错误：'.json_encode($json,JSON_UNESCAPED_UNICODE));
        }
        $token=$json['access_token'];
        return $token;
    }
}