<?php

namespace iboxs\wechat\Factory;

use iboxs\wechat\common\BaseApp;
use iboxs\wechat\lib\http\Base;
use iboxs\wechat\Factory\official_account\{user,qrcode,menu,sign};

/**
 * @property user $user 用户相关
 * @property qrcode $qrcode 二维码
 * @property menu $menu 自定义菜单
 * @property sign $sign 消息接收
 * @method static officialAccount officialAccount() 小程序
 **/
class officialAccount extends BaseApp
{
    public function __construct($config)
    {
        parent::__construct($config);
        if(function_exists('config')){
            $this->config=config('wechat.offcial');
        }
        (new Base())->setConfig($this->config);
    }

    public function __get($name){
        $class="\\iboxs\\wechat\\Factory\\official_account\\{$name}";
        if(!class_exists($class)){
            throw new \Exception('不存在的方法类');
        }
        return new $class($this->data,$this->config);
    }
}