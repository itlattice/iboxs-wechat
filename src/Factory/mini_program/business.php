<?php

namespace iboxs\wechat\Factory\mini_program;

class business extends base
{
    public function getuserphonenumber($code,$openid){
        $this->hander->url='wxa/business/getuserphonenumber';
        $this->hander->method='post';
        $this->hander->data=[
            'code'=>$code,
            'openid'=>$openid
        ];
        return $this->hander->handle();
    }
}
