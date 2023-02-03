<?php

class _empty
{
    public static function file(...$data): bool
    {
        foreach ($data as $key) {
            if (empty($_FILES[$key]['tmp_name'])) return false;
        }
        return true;
    }
}