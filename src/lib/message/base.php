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

    protected $responseMsg=[];

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
        $this->responseMsg=[
            'ToUserName'=>$this->toUserName,
            'FromUserName'=>$this->fromUserName,
            'CreateTime'=>$this->createTime,
            'MsgType'=>$this->msgType,
        ];
        switch($this->msgType){
            case 'text':
                return $this->text();
            case 'image':
                return $this->image();
            case 'voice':
                return $this->voice();
            case 'music':
                return $this->music();
            case 'news':
                return $this->news();
        }
    }

    private function news(){
        $this->responseMsg['ArticleCount']=1;
        $this->responseMsg['Articles']=$this->content;
        return $this->sendMsg();
    }

    private function music(){
        $this->responseMsg['Music']=$this->content;
        return $this->sendMsg();
    }

    private function image(){
        $this->responseMsg['Image']=$this->content;
        return $this->sendMsg();
    }

    private function voice(){
        $this->responseMsg['Voice']=$this->content;
        return $this->sendMsg();
    }

    private function text(){
        $this->responseMsg['Content']=$this->content;
        return $this->sendMsg();
    }

    private function sendMsg(){
        $xml=new XMLParse();
        $xml=$xml->data2Xml($this->responseMsg);
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