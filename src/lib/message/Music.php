<?php
namespace iboxs\wechat\lib\message;
class Music extends base
{
    protected $type='music';

    public function __construct($ThumbMediaId,string $title=null,$description=null,$MusicURL=null,$HQMusicUrl=null)
    {
        if($ThumbMediaId==''||$ThumbMediaId==null){
            return;
        }
        $this->content=[
            'ThumbMediaId'=>$ThumbMediaId,
        ];
        if($title!=null){
            $this->content['Title']=$title;
        }
        if($MusicURL!=null){
            $this->content['MusicURL']=$title;
        }
        if($HQMusicUrl!=null){
            $this->content['HQMusicUrl']=$HQMusicUrl;
        }
        if($description!=null){
            $this->content['Description']=$description;
        }
        if($HQMusicUrl!=null){
            $this->content['HQMusicUrl']=$HQMusicUrl;
        }
        $this->msgType=$this->type;
        return $this;
    }
}