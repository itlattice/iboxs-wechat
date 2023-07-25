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

    public function getToken(){
        $token=Cache::get('accessToken');
        if($token!==false){
            return $token;
        }
        if(!isset(self::$config['appid'])){
            throw new \Exception('APPID未配置');
        }
        if(!isset(self::$config['secret'])){
            throw new \Exception('SECRET未配置');
        }
        $data=[
            'grant_type'=>'client_credential',
            'appid'=>self::$config['appid'],
            'secret'=>self::$config['secret']
        ];
        $url=$this->host.'cgi-bin/token';
        $json=$this->getPageParams($url,$data,Format::FMT_JSON);
        if(isset($json['errcode'])&&$json['errcode']!=0){
            throw new \Exception('微信Token获取请求错误：'.json_encode($json,JSON_UNESCAPED_UNICODE));
        }
        $token=$json['access_token'];
        $time=$json['expires_in'];
        Cache::set('accessToken',$token,$time-600);
        return $token;
    }
}