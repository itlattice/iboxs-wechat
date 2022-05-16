<?php

namespace iboxs\wechat\applet;

use iboxs\wechat\lib\api\AppletApi;
use iboxs\wechat\lib\Base;

class user extends Base
{
    /**
     * 小程序登录
     * @param string $code 临时登录凭证 code
     * @return mixed
     */
    public function wechatLogin(string $code){
        $path=AppletApi::$url['login'];
        $url=$this->host.$path;
        $data=[
            'appid'=>$this->config['appid'],
            'secret'=>$this->config['appsecret'],
            'js_code'=>$code,
            'grant_type'=>'authorization_code'
        ];
        return $this->Get($url,$data);
    }
}