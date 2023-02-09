<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


class usersController
{
    private users $user;
    private image $image;

    public function __construct()
    {
        Login::JWT();
        $this->user = new users();
    }

    /** get one user
     * @param $token
     * @return void
     * @throws Exception|\Exception
     */
    public function get($token): void
    {
        $user = $this->user;

        // Headers
        header('Access-Control-Allow-Origin:*');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: none');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        // get data
        $data = $user->getRow($token, 'token');

        //output
        echo json_encode($data);
    }


    /**
     * get all users
     * @return void
     * @throws Exception|\Exception
     */
    public function getAll(): void
    {
        $user = $this->user;

        // Headers
        header("Access-Control-Allow-Origin:*");
        header("Content-Type: application/json");
        header("Access-Control-Allow-Method: none");
        header("Access-Control-Allow-Headers: Authorization, Content-Type");

        // get data
        $data = $user->getAll();

        // output
        echo json_encode($data);
    }

    /**
     * login with token
     * @throws Exception|\Exception
     */
    public function login(): void
    {
        // On interdit toute méthode qui n'est pas POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (_isset::post('token')) {

                _validate::post();

                $user = $this->user;
                $token = $_POST['token'];

                // Headers
                header("Access-Control-Max-Age: 3600");
                header('Access-Control-Allow-Origin: *');
                header("Access-Control-Allow-Methods: POST");
                header("Content-Type: application/json; charset=UTF-8");
                header("Access-Control-Allow-Headers: Origin, Authorization, Content-Type, Access-Control-Allow-Origin");
                http_response_code(200);


                if ($user->exists($token, 'token', 'Like')) {

                    $data = $user->getRow($token, 'token');

                    $header = [
                        'typ' => 'JWT',
                        'alg' => 'HS256'
                    ];

                    // On crée le contenu (payload)
                    $payload = [
                        'user' => $token,
                        'firstName' => $data['firstName'],
                        'lastName' => $data['lastName'],
                        'roles' => $data['role'] == 'client' ?
                            [
                                'ROLE_USER'
                            ] : [
                                'ROLE_ADMIN'
                            ],
                        'email' => $data['email'],
                    ];

                    $jwt = new JWT();

                    $authentication = $jwt->generate($header, $payload, SECRET);

                    echo json_encode(
                        array(
                            'success' => true,
                            'token' => $authentication,
                            'message' => 'connected successfully',
                            'status' => $_SERVER['REDIRECT_STATUS']
                        )
                    );

                } else {
                    http_response_code(510);
                    echo json_encode(
                        array(
                            'success' => false,
                            'message' => 'this account is not exist',
                            'status' => 504
                        )
                    );
                }

            } else {
                http_response_code(510);
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'no token',
                        'status' => 504
                    )
                );
            }
        } else {
            http_response_code(405);
            echo json_encode(
                array(
                    'success' => false,
                    'message' => 'Méthode non autorisée',
                    'status' => 405
                )
            );
        }
    }

    /**
     * user register white send token in email
     * @return void
     * @throws Exception|\Exception
     */
    public function register(): void
    {
        // On interdit toute méthode qui n'est pas POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (_isset::post('firstName', 'lastName', 'email')) {

                _validate::post();

                $user = $this->user;

                // Headers
                header("Access-Control-Max-Age: 3600");
                header('Access-Control-Allow-Origin: *');
                header("Access-Control-Allow-Methods: POST");
                header("Content-Type: application/json; charset=UTF-8");
                header("Access-Control-Allow-Headers: Origin, Authorization, Content-Type, Access-Control-Allow-Origin");
                http_response_code(200);

                $user->startTransaction();
                $email = $_POST['email'];

                if (!$user->exists($email, 'email', 'Like')) {

                    // generate token
                    $char = base64_encode($_POST['firstName'] . $email . $_POST['lastName']);
                    $token = _random::string(10, sha1($char));

                    // Get posted data
                    $data = array(
                        'token' => $token,
                        'firstName' => $_POST['firstName'],
                        'lastName' => $_POST['lastName'],
                        'email' => $_POST['email'],
                    );
                    // insert data
                    if ($user->insert($data)) {

                        // send email
                        $mail = new PHPMailer(true);
                        ob_start();
                        {
                            $flag = true;
                            try {
                                //Server settings
                                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                                $mail->isSMTP();                                            //Send using SMTP
                                $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
                                $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                                $mail->Username = 'atman.atharri@gmail.com';                     //SMTP username
                                $mail->Password = 'xakztnzayygnxzkc';                               //SMTP password
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                                $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                                //Recipients
                                $mail->setFrom('atman.atharri@gmail.com');
                                $mail->addAddress($email);
                                //Content
                                $mail->isHTML(true);                                  //Set email format to HTML
                                $mail->Subject = 'no reply';
                                $mail->Body = "your Token is : {$token}";
                                $mail->send();
                            } catch (Exception $e) {
                                $flag = false;
                                $message = $mail->ErrorInfo;
                            }
                        }
                        ob_clean();
                        if ($flag) {
                            $user->commit();
                            http_response_code(201);
                            echo json_encode(
                                array(
                                    'success' => true,
                                    'token' => $token,
                                    'message' => "registered successfully <br> We've send your token on your email address.",
                                    'status' => $_SERVER['REDIRECT_STATUS']
                                )
                            );
                        } else {
                            $user->rollback();
                            http_response_code(500);
                            echo json_encode(
                                array(
                                    'success' => false,
                                    'message' => $message ?? 'error in registered',
                                    'status' => $_SERVER['REDIRECT_STATUS']
                                )
                            );
                        }
                    } else {
                        http_response_code(500);
                        echo json_encode(
                            array(
                                'success' => false,
                                'message' => 'error in registered',
                                'status' => $_SERVER['REDIRECT_STATUS']
                            )
                        );
                    }
                } else {
                    http_response_code(510);
                    echo json_encode(
                        array(
                            'success' => false,
                            'message' => 'this email is already exists',
                            'status' => 504
                        )
                    );
                }
            } else {
                http_response_code(510);
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'account Not Created something went wrong (error in data)',
                        'status' => 504
                    )
                );
            }
        } else {
            http_response_code(405);
            echo json_encode(
                array(
                    'success' => false,
                    'message' => 'Méthode non autorisée',
                    'status' => 405
                )
            );
        }
    }

    /**
     * @throws Exception|\Exception
     */
    public function forgotPassword(): void
    {
        // On interdit toute méthode qui n'est pas POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (_isset::post('email')) {

                _validate::post();

                $user = $this->user;

                // Headers
                header("Access-Control-Max-Age: 3600");
                header('Access-Control-Allow-Origin: *');
                header("Access-Control-Allow-Methods: POST");
                header("Content-Type: application/json; charset=UTF-8");
                header("Access-Control-Allow-Headers: Origin, Authorization, Content-Type, Access-Control-Allow-Origin");
                http_response_code(200);

                $user->startTransaction();
                $email = $_POST['email'];

                if ($user->exists($email, 'email', 'Like')) {

                    $data = $user->getRow($email, 'email');

                    // generate New token
                    $char = base64_encode($data['firstName'] . $email . $data['lastName']);
                    $token = _random::string(10, sha1($char));

                    // update token
                    if ($user->update($email, ['token' => $token], 'email')) {

                        // send email
                        $mail = new PHPMailer(true);
                        ob_start();
                        {
                            $flag = true;
                            try {
                                //Server settings
                                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                                $mail->isSMTP();                                            //Send using SMTP
                                $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
                                $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                                $mail->Username = 'atman.atharri@gmail.com';                     //SMTP username
                                $mail->Password = 'xakztnzayygnxzkc';                               //SMTP password
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                                $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                                //Recipients
                                $mail->setFrom('atman.atharri@gmail.com');
                                $mail->addAddress($email);
                                //Content
                                $mail->isHTML(true);                                  //Set email format to HTML
                                $mail->Subject = 'no reply';
                                $mail->Body = "your new Token is : {$token}";
                                $mail->send();
                            } catch (Exception $e) {
                                $flag = false;
                                $message = $mail->ErrorInfo;
                            }
                        }
                        ob_clean();
                        if ($flag) {
                            $user->commit();
                            http_response_code(201);
                            echo json_encode(
                                array(
                                    'success' => true,
                                    'token' => $token,
                                    'message' => "account successfully recovered <br> We've send your token on your email address.",
                                    'status' => $_SERVER['REDIRECT_STATUS']
                                )
                            );
                        } else {
                            $user->rollback();
                            http_response_code(500);
                            echo json_encode(
                                array(
                                    'success' => false,
                                    'message' => $message ?? 'error in recovered account',
                                    'status' => $_SERVER['REDIRECT_STATUS']
                                )
                            );
                        }
                    } else {
                        http_response_code(500);
                        echo json_encode(
                            array(
                                'success' => false,
                                'message' => 'error in recovered account',
                                'status' => $_SERVER['REDIRECT_STATUS']
                            )
                        );
                    }
                } else {
                    http_response_code(510);
                    echo json_encode(
                        array(
                            'success' => false,
                            'message' => 'this email is not exist',
                            'status' => 504
                        )
                    );
                }
            } else {
                http_response_code(510);
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'no email',
                        'status' => 504
                    )
                );
            }
        } else {
            http_response_code(405);
            echo json_encode(
                array(
                    'success' => false,
                    'message' => 'Méthode non autorisée',
                    'status' => 405
                )
            );
        }
    }
}