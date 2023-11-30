<?php
namespace iboxs\wechat\lib\message;
class News extends base
{
    protected $type='news';

    public function __construct(string $title,$description,$picurl,$url)
    {
        $this->content=[
            'item'=>[
                'Title'=>$title,
                'Description'=>$description,
                'PicUrl'=>$picurl,
                'Url'=>$url
            ]
        ];
        $this->msgType=$this->type;
        return $this;
    }
}