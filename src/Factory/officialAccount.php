<?php

namespace iboxs\wechat\Factory;

use iboxs\wechat\common\BaseApp;
use iboxs\wechat\lib\http\Base;
use iboxs\wechat\Factory\official_account\{user,qrcode,menu};
use Exception;
use iboxs\wechat\lib\message\Text;
use iboxs\wechat\lib\utils\Prpcrypt;
use iboxs\wechat\lib\utils\WXBizMsgCrypt;
use iboxs\wechat\lib\utils\XMLParse;
/**
 * @property user $user 用户相关
 * @property qrcode $qrcode 二维码
 * @property menu $menu 自定义菜单
 * @method static officialAccount officialAccount() 小程序
 **/
class officialAccount extends BaseApp
{
    public function __construct($config)
    {
        parent::__construct($config);
        if(function_exists('config')){
            $this->config=config('wechat.offcial');
        }
        (new Base())->setConfig($this->config);
    }

    public function __get($name){
        $class="\\iboxs\\wechat\\Factory\\official_account\\{$name}";
        if(!class_exists($class)){
            throw new \Exception('不存在的方法类');
        }
        return new $class($this->data,$this->config);
    }

    public function handle($argc){
        $result=$this->checkSignature();
        if(!$result){
            echo "fail";
            exit();
        }
        if(isset($_GET['echostr'])){ //校验
            echo $_GET['echostr'];
            exit();
        }
        if(!is_callable($argc)){
            throw new Exception('handle内必须是闭包函数');
        }
        $xml=file_get_contents('php://input');
        $encrypt_type=$_GET['encrypt_type']??'none';
        if($encrypt_type=='aes'){
            $msgSign=$_GET['msg_signature'];
            $this->config['aes']=true;
            $pc = new WXBizMsgCrypt($this->config['token'],$this->config['EncodingAESKey'],$this->config['appid']);
            $msg=(new XMLParse())->parse($xml);
            $errCode = $pc->decryptMsg($msgSign,$_GET['timestamp'],$_GET['nonce'],$msg['Encrypt'],$m);
            if ($errCode != 0) {
                throw new Exception('解密失败:'.$errCode);
            }
            $msg=(new XMLParse())->parse($m);
        } else{
            $this->config['aes']=false;
            $msg=(new XMLParse())->parse($xml);
        }
        $result=call_user_func($argc,$msg);
        if(is_null($result)){
            return 'success';
        }
        if(is_string($result)){
            return (new Text($result))->message($this->config,$msg);
        }
        if(is_object($result)){
            $str=get_class($result);
            if(!class_exists($str)){
                throw new Exception('不支持的消息类型：'.$str);
            }
            return $result->message($this->config,$msg);
        }
        return 'success';
    }
}