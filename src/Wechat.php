<?php
/**
 * 网络抓取快速开发
 * @author  zqu zqu1016@qq.com
 */
namespace iboxs\wechat;

class Wechat
{
    public static function Client($url){
        return (new Client($url));
    }
}