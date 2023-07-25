<?php
if(!function_exists('dd')){
    function dd(...$val){
        foreach ($val as $item) {
            var_dump($item);
        }
        exit();
    }
}