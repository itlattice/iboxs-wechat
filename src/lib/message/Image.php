<?php
namespace iboxs\wechat\lib\message;
class Image extends base
{
    protected $type='image';

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