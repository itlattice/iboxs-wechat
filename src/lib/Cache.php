<?php

namespace iboxs\wechat\lib;

class Cache
{
    public static function get($key){
        if(class_exists('\\iboxs\\redis\\Redis')){
            return \iboxs\redis\Redis::basic()->get("iboxswechat:{$key}");
        }
        if(class_exists('\\Illuminate\\Support\\Facades\\Cache')){
            return Illuminate\Support\Facades\Cache::get("iboxswechat:{$key}");
        }
        if(class_exists('\\think\\facade\\Cache')){
            return \think\facade\Cache::get("iboxswechat:{$key}");
        }
        $file=__DIR__."/../cache/accesstoken.cache";
        if(!file_exists($file)){
            return false;
        }
        $info=file_get_contents($file);
        $result=json_decode($info,true);
        if($result['expire']<time()){
            return $result['result'];
        }
        return false;
    }

    public static function set($key,$val,$time){
        if(class_exists('\\iboxs\\redis\\Redis')){
            return \iboxs\redis\Redis::basic()->set("iboxswechat:{$key}",$val,$time);
        }
        if(class_exists('\\Illuminate\\Support\\Facades\\Cache')){
            return Illuminate\Support\Facades\Cache::set("iboxswechat:{$key}",$val,$time);
        }
        if(class_exists('\\think\\facade\\Cache')){
            return \think\facade\Cache::set("iboxswechat:{$key}",$val,$time);
        }
        $file=__DIR__."/../cache/accesstoken.cache";
        $result=[
            'expire'=>time()+$time,
            'result'=>$val
        ];
        file_put_contents($file,json_encode($result,256));
    }
}