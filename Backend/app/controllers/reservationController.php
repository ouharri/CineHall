<?php

use JetBrains\PhpStorm\NoReturn;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class reservationController
{
    private reservation $reservation;

    public function __construct()
    {
        $this->reservation = new reservation();
    }

    /**
     * get one reservation
     * @param $id
     * @return void
     * @throws Exception
     */
    public function get($id): void
    {
        $reservation = $this->reservation;

        // Headers
        header('Access-Control-Allow-Origin:*');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: none');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        // get data
        $data = $reservation->getRow($id);

        //output
        echo json_encode($data, JSON_THROW_ON_ERROR);
    }


    /**
     * @throws JsonException
     */
    public function getExist($user, $event): void
    {
        $reservation = $this->reservation;

        // Headers
        header('Access-Control-Allow-Origin:*');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: none');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        // get data
        $data = $reservation->getExist($user, $event);

        //output
        echo json_encode($data, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws JsonException
     */
    public function getUserExist($user, $event): void
    {
        $reservation = $this->reservation;

        // Headers
        header('Access-Control-Allow-Origin:*');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: none');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        // get data
        $data = $reservation->getUserExist($user, $event);

        //output
        echo json_encode($data, JSON_THROW_ON_ERROR);
    }


    /**
     * get all reservation
     * @return void
     * @throws Exception
     */
    public function getAll(): void
    {
        $reservation = $this->reservation;

        // Headers
        header('Access-Control-Allow-Origin:*');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: none');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        // get data
        $data = $reservation->getAll();

        // output
        echo json_encode($data, JSON_THROW_ON_ERROR);
    }

    /**
     * get all reservation
     * @return void
     * @throws Exception
     * @throws Exception
     * @throws JsonException
     */
    public function getUserReservation($user): void
    {
        $reservation = $this->reservation;

        // Headers
        header('Access-Control-Allow-Origin:*');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: none');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        // get data
        $data = $reservation->getUserReservation($user);

        // output
        echo json_encode($data, JSON_THROW_ON_ERROR);
    }

    /**
     * insert a new reservation
     * @return void
     * @throws JsonException
     * @throws Exception
     */
    public function add(): void
    {
        Login::JWT();

        // On interdit toute méthode qui n'est pas POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (_isset::post('seat', 'event', 'user')) {

                $reservation = $this->reservation;

                // Headers
                header("Access-Control-Max-Age: 3600");
                header('Access-Control-Allow-Origin: *');
                header("Content-Type: application/json; charset=UTF-8");
                header("Access-Control-Allow-Methods: POST");
                header("Access-Control-Allow-Headers: Origin, Authorization, Content-Type, Access-Control-Allow-Origin");
                http_response_code(200);

                _validate::post();

                if (!$reservation->existSeat($_POST['event'], $_POST['seat'])) {

                    // Get posted data
                    $data = array(
                        'user' => $_POST['user'],
                        'event' => $_POST['event'],
                        'seat' => $_POST['seat']
                    );
                    // insert data
                    if ($reservation->insert($data)) {
                        http_response_code(201);
                        echo json_encode(
                            array(
                                'success' => true,
                                'message' => 'reservation Created',
                                'status' => $_SERVER['REDIRECT_STATUS']
                            ),
                            JSON_THROW_ON_ERROR
                        );
                    } else {
                        http_response_code(500);
                        echo json_encode(
                            array(
                                'success' => false,
                                'message' => 'reservation Not Created',
                                'status' => $_SERVER['REDIRECT_STATUS']
                            ),
                            JSON_THROW_ON_ERROR
                        );
                    }
                } else {
                    http_response_code(510);
                    echo json_encode(
                        array(
                            'success' => false,
                            'message' => 'reservation Not Created ( seat already reserved )',
                            'status' => 504
                        ),
                        JSON_THROW_ON_ERROR
                    );
                }
            } else {
                http_response_code(510);
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'reservation Not Created (error in data)',
                        'status' => 504
                    ),
                    JSON_THROW_ON_ERROR
                );
            }
        } else {
            http_response_code(405);
            echo json_encode(
                array(
                    'success' => false,
                    'message' => 'Méthode non autorisée',
                    'status' => 405
                ),
                JSON_THROW_ON_ERROR
            );
        }
    }


    /**
     * delet reservation
     * @return void
     * @throws JsonException
     * @throws Exception
     */
    public function delete(): void
    {
        Login::JWT();

        // On interdit toute méthode qui n'est pas DELETE
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

            // Headers
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/json');
            header('Access-Control-Allow-Methods: DELETE');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

            $_DELETE = (array)json_decode(file_get_contents("php://input"), false, 512, JSON_THROW_ON_ERROR);

            if (
                _isset::delete($_DELETE, 'event') && _empty::delete($_DELETE, 'event')
                && _isset::delete($_DELETE, 'user') && _empty::delete($_DELETE, 'user')
                && _isset::delete($_DELETE, 'seat') && _empty::delete($_DELETE, 'seat')
            ) {

                $reservation = $this->reservation;

                _validate::arr($_DELETE);


                $user = $_DELETE['user'];
                $seat = $_DELETE['seat'];
                $event = $_DELETE['event'];

                if ($reservation->exists($user, 'user', 'LIKE') && $reservation->exists($seat, 'seat') && $reservation->exists($event, 'event')) {

                    // Delete reservation
                    if ($reservation->deleteReservation($user, $seat, $event)) {
                        http_response_code(201);
                        echo json_encode(
                            array(
                                'success' => true,
                                'message' => 'reservation deleted successfully',
                                'status' => $_SERVER['REDIRECT_STATUS']
                            ),
                            JSON_THROW_ON_ERROR
                        );
                    } else {
                        http_response_code(500);
                        echo json_encode(
                            array(
                                'success' => false,
                                'message' => 'reservation Not deleted',
                                'status' => $_SERVER['REDIRECT_STATUS']
                            ),
                            JSON_THROW_ON_ERROR
                        );
                    }
                } else {
                    http_response_code(401);
                    echo json_encode(
                        array(
                            'success' => false,
                            'message' => 'Error  ( reservation not exist )',
                            'status' => 401
                        ),
                        JSON_THROW_ON_ERROR
                    );
                }
            } else {
                http_response_code(401);
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'Error  ( No item for delete )',
                        'status' => 401
                    ),
                    JSON_THROW_ON_ERROR
                );
            }
        } else {
            http_response_code(405);
            echo json_encode(
                array(
                    'success' => false,
                    'message' => 'Méthode non autorisée',
                    'status' => 405
                ),
                JSON_THROW_ON_ERROR
            );
        }
    }

    /**
     * delet reservation
     * @return void
     * @throws Exception
     */
    public function deleteReservationById(): void
    {
        Login::JWT();

        // On interdit toute méthode qui n'est pas DELETE
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

            // Headers
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/json');
            header('Access-Control-Allow-Methods: DELETE');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

            $_DELETE = (array)json_decode(file_get_contents("php://input"), false, 512, JSON_THROW_ON_ERROR);

            if (_isset::delete($_DELETE, 'id') && _empty::delete($_DELETE, 'id')) {

                $reservation = $this->reservation;

                _validate::arr($_DELETE);

                $id = $_DELETE['id'];

                if ($reservation->exists($id, 'id')) {

                    // Delete reservation
                    if ($reservation->delete($id)) {

                        http_response_code(201);
                        echo json_encode(
                            array(
                                'success' => true,
                                'message' => 'reservation deleted successfully',
                                'status' => $_SERVER['REDIRECT_STATUS']
                            ),
                            JSON_THROW_ON_ERROR
                        );
                    } else {
                        http_response_code(500);
                        echo json_encode(
                            array(
                                'success' => false,
                                'message' => 'reservation Not deleted',
                                'status' => $_SERVER['REDIRECT_STATUS']
                            ),
                            JSON_THROW_ON_ERROR
                        );
                    }
                } else {
                    http_response_code(401);
                    echo json_encode(
                        array(
                            'success' => false,
                            'message' => 'Error  ( reservation not exist )',
                            'status' => 401
                        ),
                        JSON_THROW_ON_ERROR
                    );
                }
            } else {
                http_response_code(401);
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'Error  ( No item for delete )',
                        'status' => 401
                    ),
                    JSON_THROW_ON_ERROR
                );
            }
        } else {
            http_response_code(405);
            echo json_encode(
                array(
                    'success' => false,
                    'message' => 'Méthode non autorisée',
                    'status' => 405
                ),
                JSON_THROW_ON_ERROR
            );
        }
    }

    /**
     * send Ticket by email
     * @param $id
     * @return void
     * @throws JsonException
     * @throws Exception
     */
    public function sendTicket(): void
    {
        Login::JWT();

        // On interdit toute méthode qui n'est pas POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (_isset::post('id')) {

                $reservation = $this->reservation;

                // Headers
                header("Access-Control-Max-Age: 3600");
                header('Access-Control-Allow-Origin: *');
                header("Content-Type: application/json; charset=UTF-8");
                header("Access-Control-Allow-Methods: POST");
                header("Access-Control-Allow-Headers: Origin, Authorization, Content-Type, Access-Control-Allow-Origin");
                http_response_code(200);

                _validate::post();

                $id = (int)$_POST['id'];

                $data = $this->reservation->getReservationById($id);

                if ($data) {

                    $email = $data['userEmailn'];

                    $css = file_get_contents(url('/') . "ticket.css");

                    $html = <<<HTML
                    <div class="container" style="
                    display: flex !important;
                    max-width: 1350px;
                    margin: 0 auto;
                    overflow: hidden
                    ">
                      <div class="item" style="
                      display: flex!important;
                      width: 100%;
                      height: 346px !important;
                      float: left;
                      padding: 0 10px;
                      background: #fff;
                      overflow: hidden;
                      margin: 10px
                      ">
                        <div style=" display: flex!important;">
                           <div style="text-align: center">
                                <div style="display: flex">
                                    <div style="padding: 5px">
                                        <img src="https://res.cloudinary.com/dggvib6ib/image/upload/v1678284092/logo_pfofug.png" alt="logo">
                                    </div>
                                    <div class="tracking-wide dark:text-white flex-1" style="color: #a1a8b7;flex: 1;padding-top: 5px;font-weight: bold;font-size: medium">
                                      CineHall<span style="color: red">.</span>
                                    </div>
                                </div>
                                <div class="item-right" style="
                                float: left;
                                padding: 79px 50px;
                                z-index: 5 !important;
                                display: flex;
                                align-items: center;
                                margin-right: 20px;
                                width: 25%;
                                position: relative;
                                height: 286px;
                                ">
                                <div style="text-align: center;
                                ">
                                      <h2 class="num" style="
                                      font-size: 60px;
                                      text-align: center;
                                      color: red;
                                      ">$data[seat]</h2>
                                      <p class="day" style="
                                      color: #555;
                                      font-size: 15px;
                                      margin-bottom: 9px;
                                      ">SEAT</p>
                                  </div>
                                </div>
                           </div>
                            
                            <div style="display: flex">
                                <div class="item-left">
                                  <p class="event" style="color: red;">Movie Event</p>
                                  <h2 class="title">$data[movieName]</h2>
                                  
                                  <div class="fix"></div>
                                  
                                  <div class="fix">
                                    <div class="sce">
                                        <div class="icon">
                                          <i class="fa fa-table"></i>
                                        </div>
                                        <p>HALL: $data[hall]</p>
                                    </div>
                                  </div>
                                  
                                  <div class="fix"></div>
                                  
                                  <div class="sce">
                                    <div class="icon">
                                      <i class="fa fa-table"></i>
                                    </div>
                                    <p>Date: $data[eventdate]</p>
                                  </div>
                                  
                                  <div class="fix"></div>
                                  
                                  <div class="fix">
                                    <div class="sce">
                                        <div class="icon">
                                          <i class="fa fa-table"></i>
                                        </div>
                                        <p>Time: $data[eventTime]</p>
                                    </div>
                                  </div>
                                  
                                  <div class="fix"></div>
                                  
                                  <div class="sce">
                                    <div class="icon">
                                      <i class="fa fa-table"></i>
                                    </div>
                                    <p>For: $data[firstName] $data[lastName]</p>
                                  </div>
                                  
                                  <div class="fix"></div>
                                  
                                  <div class="loc">
                                    <div class="icon">
                                      <i class="fa fa-map-marker"></i>
                                    </div>
                                    <p>$data[userEmailn]</p>
                                  </div>
                                  <br>
                                  <div style="display: flex;width: 100%;justify-content: space-between">
                                      <div class="fix" style="clear: both;margin-top: 20px !important;">
                                          <span style="color: red;">
                                            Price: 
                                          </span>
                                            $data[eventPrice] DH
                                      </div>
                                      &nbsp;&nbsp;&nbsp;&nbsp;
                                      &nbsp;&nbsp;&nbsp;&nbsp;
                                      &nbsp;&nbsp;&nbsp;&nbsp;
                                      &nbsp;&nbsp;&nbsp;&nbsp;
                                      &nbsp;&nbsp;&nbsp;&nbsp;
                                      &nbsp;&nbsp;&nbsp;&nbsp;
                                      <button class="tickets" style="
                                      background-color: red;
                                      margin-bottom: 10px;
                                      ">Tickets</button>
                                  </div>
                                  <div class="fix"></div>
                                </div>
                                <img src="$data[movieImage]" alt="movie" style="margin-left: 53px;width: 200px; z-index: 1;opacity: 40% !important;" />
                            </div>
                        </div>
                      </div> 
                    </div> 
HTML;

                    // send email
                    $mail = new PHPMailer(true);
                    ob_start();
                    {
                        $flag = true;
                        try {
                            //Server settings
                            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                            $mail->isSMTP();
                            $mail->Host = $_ENV['MAIL_HOST'];
                            $mail->SMTPAuth = true;
                            $mail->Username = $_ENV['MAIL_USERNAME'];
                            $mail->Password = $_ENV['MAIL_PASSWORD'];
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                            $mail->Port = $_ENV['MAIL_PORT'];
                            //Recipients
                            $mail->setFrom($_ENV['MAIL_USERNAME'], 'CineHall');
                            $mail->addAddress($email);
                            //Content
                            $mail->isHTML(true);
                            $mail->Subject = 'no reply';
                            $mail->Body = "
                            <html lang='eng'>
                                <head>
                                    <title>Ticket</title>
                                    <style>
                                        $css
                                    </style>
                                </head>
                                <body style='background:#DDD;
                                font-family: Cabin, sans-serif;
                                padding-bottom: 15px;
                                display:flex !important;
                                min-width: 600px !important;
                                height: 370px !important;'>
                                    $html
                                </body>
                            </html>
                            ";
                            $mail->send();
                        } catch (Exception $e) {
                            $flag = false;
                            $message = $mail->ErrorInfo;
                        }
                    }
                    ob_clean();
                    if ($flag) {
                        http_response_code(201);
                        echo json_encode(
                            array(
                                'success' => true,
                                'message' => "Ticket sent successfully to $email",
                                'status' => $_SERVER['REDIRECT_STATUS']
                            ),
                            JSON_THROW_ON_ERROR);
                    } else {
                        http_response_code(500);
                        echo json_encode(
                            array(
                                'success' => false,
                                'message' => $message ?? 'error in sending Ticket',
                                'status' => $_SERVER['REDIRECT_STATUS']
                            ),
                            JSON_THROW_ON_ERROR);
                    }
                } else {
                    http_response_code(510);
                    echo json_encode(
                        array(
                            'success' => false,
                            'message' => 'reservation not exist',
                            'status' => 504
                        ),
                        JSON_THROW_ON_ERROR);
                }
            } else {
                http_response_code(510);
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'ticket not exist (data is not valid)',
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
}
