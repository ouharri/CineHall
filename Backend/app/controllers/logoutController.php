<?php

class logoutController
{
    public function index(): void
    {
        $url = explode('/', trim($_SERVER['HTTP_REFERER'], '/'))[3];

        unset($_SESSION['user']['img_u']);
        unset($_SESSION['user']['id_u']);
        unset($_SESSION['user']['firstName_u']);
        unset($_SESSION['user']['lastName_u']);
        unset($_SESSION['user']['email_u']);
        unset($_SESSION['user']['isAdmin']);

        session_destroy();
        redirect($url);
    }
}