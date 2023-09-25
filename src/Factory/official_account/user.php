<?php

namespace iboxs\wechat\Factory\official_account;

class user extends base
{
    public function __construct($data)
    {
        $this->data = $data;
        $this->hander = $this->getHandler($this->host);
    }

    /**
     * 获取用户列表
     * @param string|null $nextOpenid 第一个拉取的OPENID，不填默认从头开始拉取
     * @return array
     */
    public function get($nextOpenid=null){
        $this->hander->url='cgi-bin/user/get';
        $this->hander->method='get';
        $this->hander->data=[
            'count'=>100
        ];
        if($nextOpenid!=null){
            $this->hander->data=[
                'count'=>100,
                'next_openid'=>$nextOpenid
            ];
        }
        return $this->hander->handle();
    }

    /**
     * 获取用户基本信息(UnionID机制)
     * @param string $openID 普通用户的标识，对当前公众号唯一
     * @param string $lang 返回国家地区语言版本，zh_CN 简体，zh_TW 繁体，en 英语
     * @return array
     */
    public function info($openID,$lang='zh_CN'){
        $this->hander->url='cgi-bin/user/info';
        $this->hander->method='get';
        $this->hander->data=[
            'openid'=>$openID,
            'lang'=>$lang
        ];
        return $this->hander->handle();
    }
}