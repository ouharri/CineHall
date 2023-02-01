<?php

class changePasswordController
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
        $data = [];
        $db = new users();
        if (isset($_GET['reset'])) {
            if ($db->getRowByCode($_GET['reset'])) {
                if (isset($_POST['password'])) {
                    $password = md5(validateData::validate_data($_POST['password']));
                    $confirmPassword = md5(validateData::validate_data($_POST['confirmPassword']));
                    if ($password === $confirmPassword) {
                        if($db->updateByCode($_GET['reset'],['password'=>$password,'code'=>''])) {
                            notif::add('Password changed successfully <br> Login now','success');
                            redirect('login');
                            exit();
                        }
                    } else {
                        $data['msg'] = "<div class='alert alert-danger'>Password and Confirm Password do not match.</div>";
                    }
                }
            } else {
                $data['msg'] = "<div class='alert alert-danger'>Reset Link do not match.</div>";
            }
        } else {
            header("Location:");
        }
        View::load('connection/changePassword', $data);
    }
}