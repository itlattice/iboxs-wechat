<?php

namespace iboxs\wechat\client;

use iboxs\wechat\common\BaseApp;

class miniProgram extends BaseApp
{
    public function __construct($config)
    {
        parent::__construct($config);
        if(function_exists('config')){
            $this->config=config('wechat.miniprogram');
        }
    }
}