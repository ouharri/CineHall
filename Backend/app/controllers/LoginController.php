<?php

class LoginController
{
    public function __construct()
    {
    }

    /**
     * @throws Exception
     */
    public function index(): void
    {
        $data = [];
        $db = new users();
        $url = explode('/', trim($_SERVER['HTTP_REFERER'] ?? '', '/'));
        $url = (isset($url[3])) ? $url[3] : 'Home';
        if (isset($_GET['verification'])) {
            if ($db->getRowByCode($_GET['verification'])) {
                if ($db->updateByCode($_GET['verification'], ['code' => ''])) {
                    $data['msg'] = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
                }
            } else {
                redirect('login');
            }
        } else if (isset($_POST['email']) && $_POST['password']) {
            $email = validateData::validate_data($_POST['email']);
            $password = md5(validateData::validate_data($_POST['password']));
            if ($db->getUser($email, $password)) {
                $data['user'] = $db->getUser($email, $password);
                $imgdata = $data['user']['img'];
                $f = finfo_open();
                $mime_type = finfo_buffer($f, $imgdata, FILEINFO_MIME_TYPE);
                if ($mime_type != 'text/plain') {
                    $imgdata = "data:{$mime_type};charset=utf8;base64," . base64_encode($data['user']['img']) . '"';
                } else {
                    $imgdata = "data:image/svg+xml;utf8," . addslashes(htmlentities(base64_decode($data['user']['img']))) . '"';
                }
                $_SESSION['user']['img_u'] = $imgdata;
                $_SESSION['user']['id_u'] = $data['user']['id'];
                $_SESSION['user']['firstName_u'] = $data['user']['firstName'];
                $_SESSION['user']['lastName_u'] = $data['user']['lastName'];
                $_SESSION['user']['email_u'] = $data['user']['email'];
                $_SESSION['user']['isAdmin'] = $data['user']['is_admin'];
                if (empty($data['user']['code'])) {
                    if ($data['user']['is_admin']) {
                        redirect('dashboard');
                    } else {
                        redirect($url);
                    }
                } else {
                    $data['msg'] = "<div class='alert alert-info'>First verify your account and try again.</div>";
                }
            } else {
                $data['msg'] = "<div class='alert alert-danger'>Email or password do not match.</div>";
            }
        }
        View::load('connection/login', $data);
    }
}