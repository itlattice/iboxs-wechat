<?php

namespace iboxs\wechat\lib\http;

use iboxs\wechat\lib\Format;

class Post extends Base
{
    public static function __callStatic($name,$arg){
        $class=new self();
        $fun=$name."Static";
        return $class->$fun($arg);
    }

    public function handleStatic($arg){
        list($hasToken,$handler)=$arg;
        $url=$this->host.$handler->url."?";
        if($hasToken){
            $url.='access_token='.$this->getToken();
        }
        $postdata=Format::formatParams($handler->data,$handler->requestformat);
        return $this->PostJson($url,$postdata);
    }
}