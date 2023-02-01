<?php

use JetBrains\PhpStorm\NoReturn;

class usersController
{
    /**
     * @throws Exception
     */
    public function getImage($id): bool|string
    {
        $users = new users();
        $tmp = $users->getRow($id);
        $imgdata = $tmp['img'];
        $f = finfo_open();
        $mime_type = finfo_buffer($f, $imgdata, FILEINFO_MIME_TYPE);
        if ($mime_type != 'text/plain') {
            $imgdata = "data:{$mime_type};charset=utf8;base64," . base64_encode($tmp['img']) . '"';
            $imgdata = url("users/getImage/"). $id;
        } else {
            $imgdata = base64_decode($tmp['img']);
        }
        return $imgdata;
    }
}