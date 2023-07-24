<?php

namespace iboxs\wechat\lib;

trait Http
{
    public $host="https://api.weixin.qq.com";

    public function getPage($url,$data,$format="json"){
        $url=$this->host.$url;
        $data=http_build_str($data);
        $html=file_get_contents($url."?".$data);
        return Format::formatInfo($html,$format);
    }
}