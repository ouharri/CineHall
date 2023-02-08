<?php

function randomString($n)
{
    $characters = substr(md5(uniqid(rand(), true)), 0, 10) . session_id();;
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }

    return $str;
}
