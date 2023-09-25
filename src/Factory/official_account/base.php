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

    protected $config;

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

    public function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        
        $token = $this->config;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}