<?php

namespace iboxs\wechat\lib;

use iboxs\wechat\lib\http\Get;
use iboxs\wechat\lib\http\Post;

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
        }
    }

    private function httpPost($hasToken){
        return Post::handle($hasToken,$this);
    }

    private function httpGet($hasToken){
        return Get::handle($hasToken,$this);
    }
}