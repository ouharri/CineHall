<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class registerController
{
    /**
     * @throws Exception|\Exception
     */
    public function index(): void
    {
        $data = [];
        if (isset($_POST['email'])) {
            $db = new users();
            $code = md5(rand());
            $email = validate::_string($_POST['email']);
            $lastName = validate::_string($_POST['lastName']);
            $firstName = validate::_string($_POST['firstName']);
            $password = md5(validate::_string($_POST['password']));
            $confirmPassword = md5(validate::_string($_POST['confirmPassword']));
            if ($db->getRowByMail($email)) {
                $data['msg'] = "<div class='alert alert-danger'>{$email} - This email address has been already exists.</div>";
            } else {
                if ($password === $confirmPassword) {
                    $dataUser = array(
                        'firstName' => $firstName,
                        'lastName' => $lastName,
                        'email' => $email,
                        'password' => $password,
                        'code' => $code,
                        'is_admin' => 0
                    );
                    if ($db->insert($dataUser)) {
                        $mail = new PHPMailer(true);
                        echo "<div style='display: none;'>";
                        {
                            $flag = true;
                            try {
                                //Server settings
                                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                                $mail->isSMTP();                                            //Send using SMTP
                                $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
                                $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                                $mail->Username = 'atman.atharri@gmail.com';                     //SMTP username
                                $mail->Password = 'jbpdcdxbpzmsfmzn';                               //SMTP password
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                                $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                                //Recipients
                                $mail->setFrom('atman.atharri@gmail.com');
                                $mail->addAddress($email);
                                //Content
                                $mail->isHTML(true);                                  //Set email format to HTML
                                $mail->Subject = 'no reply';
                                $mail->Body = 'Here is the verification link <b><a href="' . url('login') . '/?verification=' . $code . '">' . url("login") . '/?verification=' . $code . '</a></b>';
                                $mail->send();
                                echo 'Message has been sent';
                            } catch (Exception $e) {
                                $flag = false;
                                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            }
                        }
                        echo "</div>";
                        if ($flag){
                            $data['msg'] = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
                        }
                        else{
                            $data['msg'] = "<div class='alert alert-danger'>We Dont send a verification link ! (Something wrong went).</div>";
                        }
                    } else {
                        $data['msg'] = "<div class='alert alert-danger'>Something wrong went.</div>";
                    }
                } else {
                    $data['msg'] = "<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
                }
            }
        }
        View::load('connection/register', $data);
    }
}