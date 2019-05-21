<?php
/**
 * Created by PhpStorm.
 * User: j4jan
 * Date: 18/05/2019
 * Time: 2:01 PM
 */
function utf8_converter($array)
{
    array_walk_recursive($array, function(&$item, $key){
        if(!mb_detect_encoding($item, 'utf-8', true)){
            $item = utf8_encode($item);
        }
    });

    return $array;
}


?>