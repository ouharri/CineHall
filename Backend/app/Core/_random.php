<?php

class _random
{
    /**
     * @throws Exception
     */
    public static function string($n, $char): string
    {
        $characters = substr($char, 0, floor(strlen($char) / 3)) .
            substr(md5(uniqid(mt_rand(), true)), 0, 10) .
            substr($char, floor(strlen($char) / 3), floor(strlen($char) / 3)) . session_id() .
            substr($char, 2 * floor(strlen($char) / 3), strlen($char));

        $str = '';

        for ($i = 0; $i < $n; $i++) {
            $index = random_int(0, strlen($characters) - 1);
            $str .= $characters[$index];
        }

        return $str;
    }
}