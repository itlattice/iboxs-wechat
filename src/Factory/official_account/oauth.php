<?php

namespace iboxs\wechat\Factory\official_account;

use Exception;

class oauth extends base
{
    public function authorize(string $redictUrl){
        $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->config['app_id']}&redirect_uri=".urlencode($redictUrl)."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
        return redirect($url);
    }

    public function user(string $code){
        $this->hander->url='sns/oauth2/access_token';
        $this->hander->method='get';
        $data=[
            'secret'=>$this->config['secret'],
            'appid'=>$this->config['app_id'],
            'code'=>$code,
            'grant_type'=>'authorization_code'
        ];
        $this->hander->data=$data;
        return $this->hander->handle();
    }
}
