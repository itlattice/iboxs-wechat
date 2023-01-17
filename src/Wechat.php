<?php

namespace iboxs\wechat;
use iboxs\wechat\common\until\Applet as UntilApplet;
use iboxs\wechat\common\until\Official as UntilOfficial;
use iboxs\wechat\common\until\Openapp as UntilOpenapp;

class Wechat
{
    protected $config;

    public function __construct($config)
    {
        $this->config=$config;
    }

    public function applet(){
        return (new UntilApplet($this->config));
    }

    public function official(){
        return (new UntilOfficial($this->config));
    }

    public function openapp(){
        return (new UntilOpenapp($this->config));
    }
}