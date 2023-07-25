<?php

namespace iboxs\wechat\lib\utils;

use iboxs\wechat\lib\Format;

trait Http
{
    public function getPageParams($url,$params,$format='json'){
        $url=$url."?".http_build_query($params);
        return $this->getPage($url,$format);
    }
    public function getPage($url,$format="json"){
        $html=file_get_contents($url);
        return Format::formatInfo($html,$format);
    }

    public function PostForm($url,$postdata,$format="json"){
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type:application/x-www-form-urlencoded;charset=utf-8',
                'content' => $postdata,
                'timeout' => 15 // 超时时间（单位:s）
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return Format::formatInfo($result,$format);
    }

    public function PostJson($url,$postdata,$format="json"){
        $httph = curl_init($url);
        curl_setopt($httph, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($httph, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($httph, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($httph, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
        $headers = array(
            'Content-Type: application/json;charset=UTF-8'
        );
        curl_setopt($httph, CURLOPT_POST, 1);//设置为POST方式
        curl_setopt($httph, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($httph, CURLOPT_CONNECTTIMEOUT, 3);//设置超时时间
        curl_setopt($httph, CURLOPT_HTTPHEADER, $headers);
        $rst = curl_exec($httph);
        curl_close($httph);
        return Format::formatInfo($rst,$format);
    }
}