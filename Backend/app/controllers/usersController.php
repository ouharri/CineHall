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
        $this->user = new users();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, Authorization, Content-Type, Access-Control-Allow-Origin");
    }

    /** get one user
     * @param $token
     * @return void
     * @throws \Exception
     */
    public function get($token): void
    {
        Login::JWT();
        $user = $this->user;

        header('Access-Control-Allow-Origin:*');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: none');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        $data = $user->getRow($token, 'token');

        echo json_encode($data, JSON_THROW_ON_ERROR);
    }


    /**
     * get all users
     * @return void
     * @throws \Exception
     */
    public function getAll(): void
    {
        Login::JWT();
        $user = $this->user;

        header("Access-Control-Allow-Origin:*");
        header("Content-Type: application/json");
        header("Access-Control-Allow-Method: none");
        header("Access-Control-Allow-Headers: Authorization, Content-Type");

        $data = $user->getAll();

        echo json_encode($data, JSON_THROW_ON_ERROR);
    }

    /**
     * login with token
     * @throws \Exception
     */
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (_isset::post('token')) {

                _validate::post();

                $user = $this->user;
                $token = $_POST['token'];
                $remember = $_POST['remember'];

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

                    $payload = [
                        'user' => $token,
                        'firstName' => $data['firstName'],
                        'lastName' => $data['lastName'],
                        'avatar' => $data['avatar'],
                        'roles' => $data['role'] === 'client' ?
                            [
                                'ROLE_USER'
                            ] : [
                                'ROLE_ADMIN'
                            ],
                        'email' => $data['email'],
                    ];

                    $jwt = new JWT();

                    $authentication = $jwt->generate($header, $payload, SECRET, $remember ? 31556952 : 3600);

                    echo json_encode(
                        array(
                            'success' => true,
                            'token' => $authentication,
                            'message' => 'connected successfully',
                            'user' => $data['firstName'] . ' ' . $data['lastName'],
                            'status' => $_SERVER['REDIRECT_STATUS']
                        ),
                        JSON_THROW_ON_ERROR);

                } else {
                    http_response_code(510);
                    echo json_encode(
                        array(
                            'success' => false,
                            'message' => 'this account is not exist',
                            'status' => 504
                        ),
                        JSON_THROW_ON_ERROR);
                }

            } else {
                http_response_code(510);
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'no token',
                        'status' => 504
                    ),
                    JSON_THROW_ON_ERROR);
            }
        } else {
            http_response_code(405);
            echo json_encode(
                array(
                    'success' => false,
                    'message' => 'Méthode non autorisée',
                    'status' => 405
                ),
                JSON_THROW_ON_ERROR);
        }
    }

    /**
     * user register white send token in email
     * @return void
     * @throws \Exception
     */
    public function register(): void
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (_isset::post('firstName', 'lastName', 'email')) {

                _validate::post();

                $user = $this->user;

                header("Access-Control-Max-Age: 3600");
                header('Access-Control-Allow-Origin: *');
                header("Access-Control-Allow-Methods: POST");
                header("Content-Type: application/json; charset=UTF-8");
                header("Access-Control-Allow-Headers: Origin, Authorization, Content-Type, Access-Control-Allow-Origin");
                http_response_code(200);

                $user->startTransaction();
                $email = $_POST['email'];

                if (!$user->exists($email, 'email', 'Like')) {

                    $char = base64_encode($_POST['firstName'] . $email . $_POST['lastName']);
                    $token = _random::string(10, sha1($char));

                    $data = array(
                        'token' => $token,
                        'firstName' => $_POST['firstName'],
                        'lastName' => $_POST['lastName'],
                        'email' => $_POST['email'],
                    );

                    if ($user->insert($data)) {

                        $mail = new PHPMailer(true);
                        ob_start();
                        {
                            $flag = true;
                            try {
                                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                                $mail->isSMTP();
                                $mail->Host = $_ENV['MAIL_HOST'];
                                $mail->SMTPAuth = true;
                                $mail->Username = $_ENV['MAIL_USERNAME'];
                                $mail->Password = $_ENV['MAIL_PASSWORD'];
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                                $mail->Port = $_ENV['MAIL_PORT'];
                                $mail->setFrom($_ENV['MAIL_USERNAME'], 'cinehall');
                                $mail->addAddress($email);
                                $mail->isHTML(true);
                                $mail->Subject = 'no reply';
                                $mail->Body = <<<HTML
                                    <center>
                                        <center>
                                            <div style="display: flex;justify-content: center;align-items: center;text-align: center">
                                                <div style="display: flex;padding: 5px">
                                                    <h1>Hello $_POST[firstName] To</h1>
                                                </div>    
                                                <div style="display: flex;padding-top: 25px;">
                                                        <div style="padding: 5px">
                                                            <img src="https://res.cloudinary.com/dggvib6ib/image/upload/v1678284092/logo_pfofug.png"
                                                                 alt="logo">
                                                        </div>
                                                        <div class="tracking-wide dark:text-white flex-1"
                                                             style="color: #a1a8b7;flex: 1;padding-top: 5px;font-weight: bold;font-size: medium">
                                                            CineHall<span style="color: red">.</span>
                                                        </div>
                                                </div>
                                            </div>
                                        </center>
                                        
                                        <br>
                                        <br>
                                        
                                        <center>
                                            <h3>
                                                your Token is : 
                                                <span style="color: red; font-weight: bold"> $token </span>
                                            </h3>
                                        </center> 
                                        
                                    </center>
                                HTML;
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
                                ),
                                JSON_THROW_ON_ERROR);
                        } else {
                            $user->rollback();
                            http_response_code(500);
                            echo json_encode(
                                array(
                                    'success' => false,
                                    'message' => $message ?? 'error in registered',
                                    'status' => $_SERVER['REDIRECT_STATUS']
                                ),
                                JSON_THROW_ON_ERROR);
                        }
                    } else {
                        http_response_code(500);
                        echo json_encode(
                            array(
                                'success' => false,
                                'message' => 'error in registered',
                                'status' => $_SERVER['REDIRECT_STATUS']
                            ),
                            JSON_THROW_ON_ERROR);
                    }
                } else {
                    http_response_code(510);
                    echo json_encode(
                        array(
                            'success' => false,
                            'message' => 'this email is already exists',
                            'status' => 504
                        ),
                        JSON_THROW_ON_ERROR);
                }
            } else {
                http_response_code(510);
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'account Not Created something went wrong (error in data)',
                        'status' => 504
                    ),
                    JSON_THROW_ON_ERROR);
            }
        } else {
            http_response_code(405);
            echo json_encode(
                array(
                    'success' => false,
                    'message' => 'Méthode non autorisée',
                    'status' => 405
                ),
                JSON_THROW_ON_ERROR);
        }
    }

    /**
     * send new token for login in email
     * @throws \Exception
     */
    public function forgotToken(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (_isset::post('email')) {

                _validate::post();

                $user = $this->user;

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

                    $char = base64_encode($data['firstName'] . $email . $data['lastName']);
                    $token = _random::string(10, sha1($char));

                    if ($user->update($email, ['token' => $token], 'email')) {

                        $mail = new PHPMailer(true);
                        ob_start();
                        {
                            $flag = true;
                            try {
                                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                                $mail->isSMTP();                                            //Send using SMTP
                                $mail->Host = $_ENV['MAIL_HOST'];                     //Set the SMTP server to send through
                                $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                                $mail->Username = $_ENV['MAIL_USERNAME'];                     //SMTP username
                                $mail->Password = $_ENV['MAIL_PASSWORD'];                               //SMTP password
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                                $mail->Port = $_ENV['MAIL_PORT'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                                $mail->setFrom($_ENV['MAIL_USERNAME'], 'cineHall');
                                $mail->addAddress($email);
                                $mail->isHTML(true);                                  //Set email format to HTML
                                $mail->Subject = 'no reply';
                                $mail->Body = <<<HTML
                                    <center>
                                        <center>
                                            <center style="display: flex;justify-content: center !important;align-items: center;text-align: center;">
                                                <div style="display: flex;padding: 5px">
                                                    <h1>welcome <span style="color: red">$data[firstName]</span> back To </h1>
                                                </div>
                                                <div style="display: flex;padding-top: 25px;">
                                                        <div style="padding: 5px">
                                                            <img src="https://res.cloudinary.com/dggvib6ib/image/upload/v1678284092/logo_pfofug.png"
                                                                 alt="logo">
                                                        </div>
                                                        <div class="tracking-wide dark:text-white flex-1"
                                                             style="color: #a1a8b7;flex: 1;padding-top: 5px;font-weight: bold;font-size: medium">
                                                            CineHall<span style="color: red">.</span>
                                                        </div>
                                                </div>
                                            </center>
                                        </center>    
                                        
                                        <br>
                                        <br>
                                        
                                        <center>
                                            <h3 style="display: flex;">
                                                your new Token is : 
                                                <span style="color: red; font-weight: bold"> $token </span>
                                            </h3> 
                                        </center>   
                                        
                                    </center>
                                HTML;
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
                                ),
                                JSON_THROW_ON_ERROR);
                        } else {
                            $user->rollback();
                            http_response_code(500);
                            echo json_encode(
                                array(
                                    'success' => false,
                                    'message' => $message ?? 'error in recovered account',
                                    'status' => $_SERVER['REDIRECT_STATUS']
                                ),
                                JSON_THROW_ON_ERROR);
                        }
                    } else {
                        http_response_code(500);
                        echo json_encode(
                            array(
                                'success' => false,
                                'message' => 'error in recovered account',
                                'status' => $_SERVER['REDIRECT_STATUS']
                            ),
                            JSON_THROW_ON_ERROR);
                    }
                } else {
                    http_response_code(510);
                    echo json_encode(
                        array(
                            'success' => false,
                            'message' => 'this email is not exist',
                            'status' => 504
                        ),
                        JSON_THROW_ON_ERROR);
                }
            } else {
                http_response_code(510);
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'no email',
                        'status' => 504
                    ),
                    JSON_THROW_ON_ERROR);
            }
        } else {
            http_response_code(405);
            echo json_encode(
                array(
                    'success' => false,
                    'message' => 'Méthode non autorisée',
                    'status' => 405
                ),
                JSON_THROW_ON_ERROR);
        }
    }

    /**
     * @throws JsonException
     */
    public function tokenIsValid(): void
    {
        Login::JWT();
        echo json_encode([
            'success' => true,
        ], JSON_THROW_ON_ERROR);
    }
}