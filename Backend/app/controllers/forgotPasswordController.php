<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class forgotPasswordController{
    /**
     * @throws Exception|\Exception
     */
    public function index(): void
    {
        $data = [];
        if (isset($_POST['email'])) {
            $db = new users();
            $email = validateData::validate_data($_POST['email']);
            $code = md5(validateData::validate_data(md5(rand())));
            if ($db->getRowByMail($email)) {
                if ($db->updateByEmail($email,['code' => $code])) {
                    echo "<div style='display: none;'>";
                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);
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
                        $mail->Body = 'Here is the verification link <b><a href="' . url('changePassword') . '/?reset=' . $code . '">http://localhost/login/change-password.php?reset=' . $code . '</a></b>';
                        $mail->send();
                        echo 'Message has been sent';
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                    echo "</div>";
                    $data['msg'] = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
                }
            } else {
                $data['msg'] = "<div class='alert alert-danger'>$email - This email address do not found.</div>";
            }
        }
        View::load('connection/forgotPassword', $data);
    }
}