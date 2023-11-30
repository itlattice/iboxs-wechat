<?php

namespace iboxs\wechat\lib;

use iboxs\wechat\lib\http\Base;
use iboxs\wechat\lib\http\Get;
use iboxs\wechat\lib\http\Post;
use iboxs\wechat\lib\http\PostImg;

class Handle
{
    public $method;
    public $requestformat;
    public $responseformat;

    public $url;

    public $host=null;

    public $data;

    public function __construct($host,$url='',$data=[],$method='POST',$requestformat='json',$responseformat='json')
    {
        $this->method=$method;
        $this->requestformat=$requestformat;
        $this->responseformat=$responseformat;
        $this->url=$url;
        $this->host=$host;
        $this->data=$data;
    }



    public function handle($hasToken=true){
        switch ($this->method){
            case 'get':
                return $this->httpGet($hasToken);
            case 'post':
                return $this->httpPost($hasToken);
            case 'postimg':
                return $this->httpPostImg($hasToken);
        }
    }

    private function httpPostImg($hasToken){
        $result=PostImg::handle($hasToken,$this);
        if(isset($result['errcode']) &&$result['errcode']==40001){
            $result=PostImg::handle($hasToken,$this,true);
        }
        return $result;
    }

    private function httpPost($hasToken){
        $result=Post::handle($hasToken,$this);
        if(isset($result['errcode']) &&$result['errcode']==40001){
            $result=Post::handle($hasToken,$this,true);
        }
        return $result;
    }

    private function httpGet($hasToken){
        $result=Get::handle($hasToken,$this);
        if(isset($result['errcode']) && $result['errcode']==40001){
            $result=Get::handle($hasToken,$this,true);
        }
        return $result;
    }
}