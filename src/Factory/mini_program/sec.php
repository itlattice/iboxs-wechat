<?php

namespace iboxs\wechat\Factory\mini_program;

class sec extends base
{
    public function __construct($data)
    {
        $this->data=$data;
        $this->hander=$this->getHandler($this->host);
    }

    /**
     * 文本内容安全识别
     * @param string $msg 需检测的文本内容，文本字数的上限为2500字
     * @param int $scene 场景枚举值（1 资料；2 评论；3 论坛；4 社交日志）
     * @param string $openid 用户的openid（用户需在近两小时访问过小程序）
     * @return array
     */
    public function msg_sec_check(string $msg,int $scene,string $openid){
        $this->hander->url='wxa/msg_sec_check';
        $this->hander->method='post';
        $this->hander->data=[
            'content'=>$msg,
            'version'=>2,
            'scene'=>$scene,
            'openid'=>$openid
        ];
        return $this->hander->handle();
    }
}