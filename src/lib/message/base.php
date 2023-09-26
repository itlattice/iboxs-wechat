<?php
namespace iboxs\wechat\lib\message;

use iboxs\wechat\lib\utils\wxBizMsgCrypt;
use iboxs\wechat\lib\utils\XMLParse;

class base
{
    protected $toUserName;
    protected $fromUserName;
    protected $createTime;
    protected $msgType;
    protected $content;
    protected $isAes=false;
    protected $config;

    public function message($config,$msg){
        $this->fromUserName=$msg['ToUserName'];
        $this->toUserName=$msg['FromUserName'];
        $this->config=$config;
        $this->isAes=$config['aes'];
        $this->createTime=time();
        if($this->content==null){
            echo 'success';
            exit();
        }
        switch($this->msgType){
            case 'text':
                return $this->text();
        }
    }

    private function text(){
        $data=[
            'ToUserName'=>$this->toUserName,
            'FromUserName'=>$this->fromUserName,
            'CreateTime'=>$this->createTime,
            'MsgType'=>'text',
            'Content'=>$this->content
        ];
        $xml=new XMLParse();
        $xml=$xml->data2Xml($data);
        xmlheader();
        if(!$this->isAes){
            $xml="<xml>{$xml}</xml>";
            file_put_contents('../tmp/log.txt',$xml.PHP_EOL,FILE_APPEND);
            echo $xml;
            exit();
        }
        $pc = new wxBizMsgCrypt($this->config['token'],$this->config['EncodingAESKey'],$this->config['appid']);
        $pc->encryptMsg($xml,$_GET['timestamp'],$_GET['nonce'],$m);
        if($m){
            echo $m;
            file_put_contents('../tmp/log.txt',$m.PHP_EOL,FILE_APPEND);
            exit();
        }
    }
}