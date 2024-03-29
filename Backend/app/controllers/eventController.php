<?php

class eventController
{
    private event $event;

    public function __construct()
    {
        $this->event = new event();
    }

    /**
     * get the event
     * @param $id
     * @return void
     * @throws Exception
     */
    public function get($id): void
    {
        $event = $this->event;

        header('Access-Control-Allow-Origin:*');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: none');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        $data = $event->getRow($id);

        echo json_encode($data, JSON_THROW_ON_ERROR);
    }

    /**
     * get the event
     * @param $id
     * @return void
     * @throws Exception
     */
    public function getDetailEvent($id): void
    {
        $event = $this->event;

        header('Access-Control-Allow-Origin:*');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: none');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        $data = $event->getDetailEvent($id);

        echo json_encode($data, JSON_THROW_ON_ERROR);
    }

    /**
     * get the Month event
     * @param $id
     * @return void
     * @throws Exception
     */
    public function getMonthEvent(): void
    {
        $event = $this->event;

        header('Access-Control-Allow-Origin:*');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: none');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        $data = $event->getMonthEvent();

        echo json_encode($data, JSON_THROW_ON_ERROR);
    }

    /**
     * get all events
     * @return void
     * @throws Exception
     */
    public function getAll(): void
    {
        $event = $this->event;

        header('Access-Control-Allow-Origin:*');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: none');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        $data = $event->getAllEvents();

        echo json_encode($data, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws JsonException
     */
    public function getAllByDate($date): void
    {
        $event = $this->event;

        header('Access-Control-Allow-Origin:*');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: none');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        $data = $event->getAllEventsByDate($date);

        echo json_encode($data, JSON_THROW_ON_ERROR);
    }


    /**
     * insert a new event
     * @return void
     * @throws Exception
     */
    public function insert(): void
    {
        Login::JWT(true);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (_isset::post('hall', 'movie', 'date', 'time', 'price')) {

                $event = $this->event;

                header("Access-Control-Max-Age: 3600");
                header('Access-Control-Allow-Origin: *');
                header("Content-Type: application/json; charset=UTF-8");
                header("Access-Control-Allow-Methods: POST");
                header("Access-Control-Allow-Headers: Origin, Authorization, Content-Type, Access-Control-Allow-Origin");
                http_response_code(200);


                if (!$event->existsEvent(0, $_POST['date'], $_POST['hall'])) {

                    $data = array(
                        'hall' => $_POST['hall'],
                        'movie' => $_POST['movie'],
                        'date' => $_POST['date'],
                        'time' => $_POST['time']
                    );

                    if ($event->insert($data)) {
                        http_response_code(201);
                        echo json_encode(
                            array(
                                'message' => 'event Created',
                                'status' => $_SERVER['REDIRECT_STATUS']
                            ),
                            JSON_THROW_ON_ERROR
                        );
                    } else {
                        http_response_code(500);
                        echo json_encode(
                            array(
                                'message' => 'event Not Created',
                                'status' => $_SERVER['REDIRECT_STATUS']
                            ),
                            JSON_THROW_ON_ERROR
                        );
                    }
                } else {
                    http_response_code(510);
                    echo json_encode(
                        array(
                            'message' => "event is not create ( halls {$_POST['hall']} is plein in {$_POST['date']} )",
                            'status' => 504
                        ),
                        JSON_THROW_ON_ERROR
                    );
                }
            } else {
                http_response_code(510);
                echo json_encode(
                    array(
                        'message' => 'event Not Created (error in data)',
                        'status' => 504
                    ),
                    JSON_THROW_ON_ERROR
                );
            }
        } else {
            http_response_code(405);
            echo json_encode(
                array(
                    'message' => 'Méthode non autorisée',
                    'status' => 405
                ),
                JSON_THROW_ON_ERROR
            );
        }
    }


    /**
     * update the event
     * @return void
     * @throws Exception
     */
    public function update(): void
    {
        Login::JWT(true);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (_isset::post('id') && _empty::post($_POST, 'id')) {

                $event = $this->event;

                header("Access-Control-Max-Age: 3600");
                header('Access-Control-Allow-Origin: *');
                header("Content-Type: application/json; charset=UTF-8");
                header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
                header("Access-Control-Allow-Headers: Origin, Authorization, Content-Type, Access-Control-Allow-Origin");
                http_response_code(200);

                $id = $_POST['id'];

                if ($event->exists($id)) {

                    $data = _isset::post('hall') ? array_merge([], ['hall' => $_POST['hall']]) : [];
                    $data = _isset::post('date') ? array_merge($data, ['date' => $_POST['date']]) : $data;
                    $data = _isset::post('time') ? array_merge($data, ['time' => $_POST['time']]) : $data;
                    $data = _isset::post('movie') ? array_merge($data, ['movie' => $_POST['movie']]) : $data;
                    $data = _isset::post('price') ? array_merge($data, ['price' => $_POST['price']]) : $data;

                    $flag = _isset::post('hall');
                    $flag = _isset::post('time') || $flag;
                    $flag = _isset::post('movie') || $flag;
                    $flag = _isset::post('price') || $flag;

                    if ($flag) {

                        $idHall = $_POST['hall'] ?? $event->getRow($id)['hall'];
                        $dateEvent = $_POST['date'] ?? $event->getRow($id)['date'];

                        if (!$event->existsEvent($id, $dateEvent, $idHall)) {

                            if ($event->update($id, $data)) {
                                http_response_code(201);
                                echo json_encode(
                                    array(
                                        'message' => 'event updated successfully',
                                        'status' => $_SERVER['REDIRECT_STATUS']
                                    ),
                                    JSON_THROW_ON_ERROR
                                );
                            } else {
                                http_response_code(500);
                                echo json_encode(
                                    array(
                                        'message' => 'event Not updated',
                                        'status' => $_SERVER['REDIRECT_STATUS']
                                    ),
                                    JSON_THROW_ON_ERROR
                                );
                            }
                        } else {
                            http_response_code(510);
                            echo json_encode(
                                array(
                                    'message' => "event is not updated ( halls {$idHall} is plein in {$dateEvent} )",
                                    'status' => 504
                                ),
                                JSON_THROW_ON_ERROR
                            );
                        }
                    } else {
                        http_response_code(401);
                        echo json_encode(
                            array(
                                'message' => 'Error ( No data for update )',
                                'status' => 401
                            ),
                            JSON_THROW_ON_ERROR
                        );
                    }
                } else {
                    http_response_code(401);
                    echo json_encode(
                        array(
                            'message' => 'Error  ( event not exist )',
                            'status' => 401
                        ),
                        JSON_THROW_ON_ERROR
                    );
                }
            } else {
                http_response_code(401);
                echo json_encode(
                    array(
                        'message' => 'Error  ( No item for update )',
                        'status' => 401
                    ),
                    JSON_THROW_ON_ERROR
                );
            }
        } else {
            http_response_code(405);
            echo json_encode(
                array(
                    'message' => 'Méthode non autorisée',
                    'status' => 405
                ),
                JSON_THROW_ON_ERROR
            );
        }
    }


    /**
     * delet event
     * @return void
     * @throws Exception
     */
    public function delete(): void
    {
        Login::JWT(true);

        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/json');
            header('Access-Control-Allow-Methods: DELETE');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

            $_DELETE = (array)json_decode(file_get_contents("php://input"), false, 512, JSON_THROW_ON_ERROR);

            if (_isset::delete($_DELETE, 'id') && _empty::delete($_DELETE, 'id')) {
                $event = $this->event;

                $id = $_DELETE['id'];

                if ($event->exists($id)) {

                    if ($event->delete($id)) {
                        http_response_code(201);
                        echo json_encode(
                            array(
                                'message' => 'event deleted successfully',
                                'status' => $_SERVER['REDIRECT_STATUS']
                            ),
                            JSON_THROW_ON_ERROR
                        );
                    } else {
                        http_response_code(500);
                        echo json_encode(
                            array(
                                'message' => 'event Not deleted',
                                'status' => $_SERVER['REDIRECT_STATUS']
                            ),
                            JSON_THROW_ON_ERROR
                        );
                    }
                } else {
                    http_response_code(401);
                    echo json_encode(
                        array(
                            'message' => 'Error  ( event not exist )',
                            'status' => 401
                        ),
                        JSON_THROW_ON_ERROR
                    );
                }
            } else {
                http_response_code(401);
                echo json_encode(
                    array(
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
                    'message' => 'Méthode non autorisée',
                    'status' => 405
                ),
                JSON_THROW_ON_ERROR
            );
        }
    }
}
