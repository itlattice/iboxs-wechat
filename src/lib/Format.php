<?php

namespace iboxs\wechat\lib;

class Format
{
    const FMT_JSON='json';
    const FMT_XML='xml';
    const FMT_FORM='form';

    public static function formatInfo($html,$format){
        switch ($format){
            case self::FMT_JSON:
                return json_decode($html,true);
            case self::FMT_XML:
                return $html;
        }
        return $html;
    }

    public static function formatParams($params,$format){
        switch ($format){
            case self::FMT_FORM:
                return http_build_query($params);
            case self::FMT_JSON:
                return json_encode($params,256);
            case self::FMT_XML:
                return $params;
        }
        return $params;
    }
}