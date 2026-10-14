<?php

namespace iboxs\wechat\Factory\mini_program;

class qrcode extends base
{
    public function getwxacodeunlimit($scene, $page, $width){
        $this->hander->url='wxa/getwxacodeunlimit';
        $this->hander->method='postimg';
        $this->hander->data=[
            'scene'=>$scene,
            'page'=>$page,
            'width'=>$width
        ];

        return $this->hander->handle();
    }

    public function generate_urllink($path,$scene,$expire_time,$expire_type,$env_version){
        $this->hander->url='wxa/generate_urllink';
        $this->hander->method='post';
        $this->hander->data=[
            'path'=>$path,
            'query'=>$scene,
            'expire_time'=>$expire_time,
            'expire_type'=>$expire_type,
            'env_version'=>$env_version
        ];

        return $this->hander->handle();
    }
}
