<?php

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
     * insert a new reservation
     * @return void
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
}
