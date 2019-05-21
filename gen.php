<?php
/**
 * Created by PhpStorm.
 * User: j4jan
 * Date: 17/05/2019
 * Time: 7:28 PM
 */

function randomPassword($lenght)
{
    $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $keyspaceLength = strlen($keyspace) - 1;

    $pass = '';
    for ($i = 0; $i < $lenght; $i++) {
        $n = rand(0, $keyspaceLength);
        $pass .= $keyspace[$n];
    }
    return $pass;
}


?>