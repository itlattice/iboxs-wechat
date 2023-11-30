<?php

namespace iboxs\wechat\Factory\mini_program;

class user extends base
{
    /**
     * 小程序登录
     * @param string $js_code 	登录时获取的 code，可通过wx.login获取
     * @return array
     */
    public function jscode2session($js_code){
        $this->hander->url='sns/jscode2session';
        $this->hander->method='get';
        $this->hander->data=[
            'appid'=>$this->config['appid'],
            'secret'=>$this->config['secret'],
            'js_code'=>$js_code,
            'grant_type'=>'authorization_code'
        ];
        return $this->hander->handle();
    }
}