<?php
/**
 * 网络抓取快速开发
 * @author  zqu zqu1016@qq.com
 */
namespace iboxs\wechat;

class Wechat
{
    public function Applet(){
        $config=config('wechat');
        return new Applet($config);
    }

    public function Official(){
        $config=config('wechat');
        return new Official($config);
    }
}