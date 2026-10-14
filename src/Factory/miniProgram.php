<?php

namespace iboxs\wechat\Factory;

use iboxs\wechat\common\BaseApp;
use iboxs\wechat\Factory\mini_program\{user,encryptor,sec,qrcode};
use iboxs\wechat\lib\http\Base;

/**
 * @package ExpressApi
 * @property sec $sec 内容安全
 * @property qrcode $qrcode 小程序码或二维码+
 * @property user $user 用户相关
 * @property wxa $wxa 小程序服务API
 * @property encryptor $encryptor 数据加密解密
 * @property business $business 小程序业务
 * @method static miniProgram miniProgram() 小程序
 **/
class miniProgram extends BaseApp
{
    public function __construct($config)
    {
        parent::__construct($config);
        if(function_exists('config')){
            $this->config=config('wechat.miniprogram');
        }
        (new Base())->setConfig($this->config);
    }

    public function __get($name){
        $class="\\iboxs\\wechat\\Factory\\mini_program\\{$name}";
        if(!class_exists($class)){
            throw new \Exception('不存在的方法类');
        }
        return new $class($this->data,$this->config);
    }
}
