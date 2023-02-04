<?php

class _isset
{
    public static function get(...$data): bool
    {
        foreach ($data as $key){
            if(!isset($_GET[$key])) return false;
        }
        return true;
    }

    public static function post(...$data): bool
    {
        foreach ($data as $key){
            if(!isset($_POST[$key])) return false;
        }
        return true;
    }

    public static function put($_PUT,...$data): bool
    {
        foreach ($data as $key){
            if( !array_key_exists($key, $_PUT) ) return false;
        }
        return true;
    }

    public static function delete($_DELETE,...$data): bool
    {
        foreach ($data as $key){
            if( !array_key_exists($key, $_DELETE) ) return false;
        }
        return true;
    }

    public static function file(...$data): bool
    {
        foreach ($data as $key){
            if(!isset($_FILES[$key])) return false;
        }
        return true;
    }

}