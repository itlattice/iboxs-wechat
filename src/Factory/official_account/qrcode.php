<?php

namespace iboxs\wechat\Factory\official_account;

use Exception;

class qrcode extends base
{
    public function __construct($data,$config)
    {
        $this->data = $data;
        $this->config=$config;
        $this->hander = $this->getHandler($this->host);
    }

    /**
     * 生成带参数的二维码
     * @param string $action_name 二维码类型，QR_SCENE为临时的整型参数值，QR_STR_SCENE为临时的字符串参数值，QR_LIMIT_SCENE为永久的整型参数值，QR_LIMIT_STR_SCENE为永久的字符串参数值
     * @param string $scene 场景值
     * @param int $expire_seconds 该二维码有效时间，以秒为单位。 最大不超过2592000（即30天），此字段如果不填，则默认有效期为60秒。
     * @return array|false 二维码信息
     */
    public function create($action_name,$scene,$expire_seconds=60){
        $this->hander->url='cgi-bin/qrcode/create';
        $this->hander->method='post';
        $data=[
            'action_name'=>$action_name
        ];
        $data['action_info']=[];
        switch($action_name){
            case 'QR_SCENE':
                $data['action_info']['expire_seconds']=$expire_seconds;
                $data['action_info']['scene']['scene_id']=intval($scene);
                break;
            case 'QR_STR_SCENE':
                $data['action_info']['expire_seconds']=$expire_seconds;
                $data['action_info']['scene']['scene_str']=$scene.'';
                break;
            case 'QR_LIMIT_SCENE':
                $data['action_info']['scene']['scene_id']=intval($scene);
                break;
            case 'QR_LIMIT_STR_SCENE':
                $data['action_info']['scene']['scene_str']=$scene.'';
                break;
            default:
                throw new Exception('不支持的二维码类型');
        }
        $this->hander->data=$data;
        return $this->hander->handle();
    }
}