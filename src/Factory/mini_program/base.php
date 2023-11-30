<?php

namespace iboxs\wechat\Factory\mini_program;

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

    protected $config=[];

    public function getHandler(){
        $this->hander=new Handle($this->host);
        return $this->hander;
    }
    
    public function __construct($data,$config)
    {
        $this->data = $data;
        $this->config=$config;
        $this->hander = $this->getHandler($this->host);
    }
}