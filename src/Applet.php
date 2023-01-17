<?php

namespace iboxs\wechat;
use iboxs\wechat\common\Base;

/**
 * 小程序
 */
class Applet extends Base
{
    // 调用实际类的方法
    public static function __callStatic($method, $params)
    {
        $config=(new self())->getConfig();
        return (new Wechat($config))->applet()->$method(...$params);
    }
}