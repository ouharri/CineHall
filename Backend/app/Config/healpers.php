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

#[NoReturn] function debug(...$var): void
{
    echo '<pre>';
    {
        foreach ($var as $v) {
            echo '<br>';
            var_dump($v);
            echo '<br>';
        }
        echo '</pre>';
    }
    die();
}