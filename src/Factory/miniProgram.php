<?php

namespace iboxs\wechat\Factory;

use iboxs\wechat\common\BaseApp;
use iboxs\wechat\Factory\mini_program\sec;
use iboxs\wechat\lib\http\Base;

/**
 * @package ExpressApi
 * @property sec sec 安全
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
        (new Base())->setConfig($config);
    }

    public function __get($name){
        $class="\\iboxs\\wechat\\Factory\\mini_program\\{$name}";
        if(!class_exists($class)){
            throw new \Exception('不存在的方法类');
        }
        return new $class($this->data);
    }
}