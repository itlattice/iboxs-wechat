<?php
namespace iboxs\wechat\Factory\official_account;

use iboxs\wechat\lib\http\Get;

class web extends base
{
    /**
     * 微信网页授权
     * @param string $scope 应用授权作用域，snsapi_base （不弹出授权页面，直接跳转，只能获取用户openid），snsapi_userinfo （弹出授权页面，可通过openid拿到昵称、性别、所在地。并且， 即使在未关注的情况下，只要用户授权，也能获取其信息 ）
     */
    public function auth($scope,$state=null,$forcePopup=false){
        $url='https://open.weixin.qq.com/connect/oauth2/authorize';
        $data=[
            'appid'=>$this->config['appid'],
            'redirect_uri'=>$this->config['redirect_uri'],
            'response_type'=>'code',
            'scope'=>$scope,
            'state'=>$state,
            'forcePopup'=>$forcePopup
        ];
        $data=http_build_query($data);
        $url.="?".$data."#wechat_redirect";
        header("Location: ".$url);
        exit();
    }

    /**
     * 用上一步获取的code获取accessToken
     */
    public function code2token($code){
        $url='https://api.weixin.qq.com/sns/oauth2/access_token';
        $data=[
            'appid'=>$this->config['appid'],
            'secret'=>$this->config['secret'],
            'code'=>$code,
            'grant_type'=>'authorization_code'
        ];
        $data=http_build_query($data);
        $url.="?".$data;
        $res=file_get_contents($url);
        $res=json_decode($res,true);
        return $res;
    }

    /**
     * 用上一步获取的accessToken拉取用户信息
     */
    public function userinfo($accessToken,$openID,$lang='zh_CN'){
        $url="https://api.weixin.qq.com/sns/userinfo?access_token={$accessToken}&openid={$openID}&lang={$lang}";
        $res=file_get_contents($url);
        $res=json_decode($res,true);
        return $res;
    }
}