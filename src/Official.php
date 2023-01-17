<?php
namespace iboxs\wechat;

use iboxs\wechat\common\Base;

/**
 * 公众号操作类
 */
class Official extends Base
{
    // 调用实际类的方法
    public static function __callStatic($method, $params)
    {
        $config=(new self())->config['official']??[];
        return (new Wechat($config))->official()->$method(...$params);
    }
}