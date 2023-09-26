<?php
namespace iboxs\wechat\lib\message;
class Video extends base
{
    protected $type='video';

    public function __construct(string $MediaId,$Title,$Description)
    {
        if($MediaId==''||$MediaId==null){
            return;
        }
        $this->content=[
            'MediaId'=>$MediaId,
            'Title'=>$Title,
            'Description'=>$Description
        ];
        $this->msgType=$this->type;
        return $this;
    }
}