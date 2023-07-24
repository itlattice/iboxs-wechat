<?php

namespace iboxs\wechat\client;

use iboxs\wechat\common\BaseApp;

class officialAccount extends BaseApp
{
    public function __get($name){
        var_dump($name);
    }
}