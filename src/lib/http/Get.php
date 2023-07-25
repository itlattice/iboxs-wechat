<?php

namespace iboxs\wechat\lib\http;

use iboxs\wechat\lib\Format;

class Get extends Base
{
    public static function __callStatic($name,$arg){
        $class=new self();
        $fun=$name."Static";
        return $class->$fun($arg);
    }

    public function handleStatic($arg){
        list($hasToken,$handler)=$arg;
        $url=$this->host.$handler->url."?";
        $data=$handler->data;
        $str='';
        if(count($data)>0){
            $str=http_build_query($data);
        }
        if($hasToken){
            $url.='access_token='.$this->getToken()."&".$str;
        } else{
            $url.=$str;
        }
        return $this->getPage($url,$handler->responseformat);
    }
}