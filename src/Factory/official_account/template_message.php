<?php

namespace iboxs\wechat\Factory\official_account;

use Exception;

class template_message extends base
{
    public function send($data){

        $this->hander->url='cgi-bin/message/template/send';
        $this->hander->method='post';
        $this->hander->data=$data;
        return $this->hander->handle();
    }
}
