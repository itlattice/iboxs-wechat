<?php

namespace iboxs\wechat\common;

use iboxs\wechat\lib\Cache;
use iboxs\wechat\lib\Data;
use iboxs\wechat\lib\Format;
use iboxs\wechat\lib\http\Base;

class BaseApp
{
    protected $config=[];

    protected $data;
    public function __construct($config)
    {
        if(isset($config['appid'])){
            $this->config=$config;
        }
        (new Base())->setConfig($this->config);
    }
}