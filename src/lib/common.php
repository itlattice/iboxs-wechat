<?php
if(!function_exists('dd')){
    function dd(...$val){
        foreach ($val as $item) {
            var_dump($item);
        }
        exit();
    }
}
if(!function_exists('xmlheader')){
    function xmlheader(){
        header('Content-type:text/xml');
    }
}