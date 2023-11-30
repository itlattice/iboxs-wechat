<?php

namespace iboxs\wechat\lib\http;

use iboxs\wechat\lib\Format;

class PostImg extends Base
{
    public static function __callStatic($name,$arg){
        $class=new self();
        $fun=$name."Static";
        return $class->$fun($arg);
    }

    public function handleStatic($arg){
        list($hasToken,$handler)=$arg;
        $url=$this->host.$handler->url."?";
        $refresh=$arg[2]??false;
        if($hasToken){
            $url.='access_token='.$this->getToken($refresh);
        }
        $postdata=Format::formatParams($handler->data,$handler->requestformat);
        return $this->PostImage($url,$postdata);
    }
}