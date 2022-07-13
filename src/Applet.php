<?php

namespace iboxs\wechat;

use iboxs\wechat\applet\user;
use iboxs\wechat\lib\Base;

class Applet extends Base
{
    /**
     * 用户类操作
     * @return user
     */
    public function user(){
        return new user($this->config);
    }
}