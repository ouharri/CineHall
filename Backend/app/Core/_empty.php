<?php

class _empty
{
    public static function file(...$data): bool
    {
        foreach ($data as $key) {
            if (empty($_FILES[$key]['tmp_name'])) {
                return false;
            }
        }
        return true;
    }

    public static function delete($_DELETE, ...$data): bool
    {
        foreach ($data as $key) {
            if (empty($_DELETE[$key])) {
                return false;
            }
        }
        return true;
    }

    public static function post($_DELETE, ...$data): bool
    {
        foreach ($data as $key) {
            if (empty($_POST[$key])) {
                return false;
            }
        }
        return true;
    }
}