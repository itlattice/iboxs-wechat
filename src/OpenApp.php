<?php

namespace iboxs\wechat;
use iboxs\wechat\common\Base;

/**
 * 开放平台
 */
class OpenApp extends Base
{
    // 调用实际类的方法
    public static function __callStatic($method, $params)
    {
        $config=(new self())->config['openapp']??[];
        return (new Wechat($config))->openapp()->$method(...$params);
    }
}