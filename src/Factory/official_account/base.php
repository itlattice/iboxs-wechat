<?php

namespace iboxs\wechat\Factory\official_account;

use iboxs\wechat\lib\Handle;
use iboxs\wechat\lib\http\Get;

class base
{
    protected $data;
    /**
     * @var Handle
     */
    protected $hander;

    protected $host='';

    public function getHandler(){
        $this->hander=new Handle($this->host);
        return $this->hander;
    }
}