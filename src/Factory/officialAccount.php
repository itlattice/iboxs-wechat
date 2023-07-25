<?php

namespace iboxs\wechat\Factory;

use iboxs\wechat\common\BaseApp;
use iboxs\wechat\lib\Data;
use iboxs\wechat\lib\http\Base;

class officialAccount extends BaseApp
{
    /**
     * @var mixed
     */
    public $sec;

    public function __construct($config)
    {
        parent::__construct($config);
        if(function_exists('config')){
            $this->config=config('wechat.miniprogram');
        }
        (new Base())->setConfig($config);
    }

    public function __get($name){
        $class="\\iboxs\\wechat\\Factory\\official_account\\{$name}";
        if(!class_exists($class)){
            throw new \Exception('不存在的方法类');
        }
        return new $class($this->data);
    }
}