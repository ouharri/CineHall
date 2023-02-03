<?php

use JetBrains\PhpStorm\NoReturn;

function url($url = ''): string
{
    return BURL . $url;
}

function redirect($page): void
{
    header('location: ' . BURL . $page);
}

#[NoReturn] function debug($var): void
{
    echo '<pre>';
    {
        var_dump($var);
    }
    echo '</pre>';
    die();
}