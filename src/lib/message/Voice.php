<?php
namespace iboxs\wechat\lib\message;
class Voice extends base
{
    protected $type='voice';

    public function __construct(string $MediaId)
    {
        if($MediaId==''||$MediaId==null){
            return;
        }
        $this->content=[
            'MediaId'=>$MediaId
        ];
        $this->msgType=$this->type;
        return $this;
    }
}