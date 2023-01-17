<?php

namespace iboxs\wechat\common;

class Base
{
    protected $config=[];

    public static function setConfig($config){
        $class=new self();
        $class->config=$config;
        return $class;
    }

    public function getConfig(){
        $config=$this->config['applet']??[];
        if($config==[]){
            if(function_exists('config')){
                $config=config('wechat');
            } else{
                exit('无配置信息');
            }
        }
        return $config;
    }
}