<?php

namespace iboxs\wechat\Factory\official_account;

/**
 * 自定义菜单
 */
class menu extends base
{
    /**
     * 创建菜单
     * @param array $menu 菜单数组
     * @return array|false 请求结果
     */
    public function create($menu){
        $this->hander->url='cgi-bin/menu/create';
        $this->hander->method='post';
        $this->hander->data=$menu;
        return $this->hander->handle();
    }

    /**
     * 查询菜单
     * @return array|false 查询结果
     */
    public function get_current_selfmenu_info(){
        $this->hander->url='cgi-bin/get_current_selfmenu_info';
        $this->hander->method='get';
        $this->hander->data=[];
        return $this->hander->handle();
    }
}