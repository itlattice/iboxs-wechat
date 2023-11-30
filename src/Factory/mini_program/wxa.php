<?php

namespace iboxs\wechat\Factory\mini_program;

class wxa extends base
{
    /**
     * 小程序登录
     * @param string $js_code 	登录时获取的 code，可通过wx.login获取
     * @return array
     */
    public function getwxacode($path){
        $this->hander->url='wxa/getwxacode';
        $this->hander->method='postimg';
        $this->hander->data=[
            'path'=>$path,
            'is_hyaline'=>true
        ];
        return $this->hander->handle();
    }
}