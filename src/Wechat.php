<?php

namespace iboxs\wechat;
use \Exception;
use iboxs\wechat\Factory\miniProgram;
use iboxs\wechat\Factory\officialAccount;


/**
 * @package ExpressApi
 * @method static officialAccount officialAccount() 公众号
 * @method static miniProgram miniProgram() 小程序
 **/
class Wechat
{
    public static function __callStatic($name, $arguments)
    {
        $file=__DIR__."/lib/common.php";
        require_once $file;
        $class="\\iboxs\\wechat\\Factory\\{$name}";
        if(!class_exists($class)){
            throw new Exception('不支持的接口类');
        }
        return new $class($arguments[0]??[]);
    }
}
