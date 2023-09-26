<?php
namespace iboxs\wechat\lib\message;
class Text extends base
{
    protected $type='text';

    public function __construct(string $message)
    {
        if($message==''||$message==null){
            return;
        }
        $this->content=$message;
        $this->msgType='text';
        return $message;
    }
}