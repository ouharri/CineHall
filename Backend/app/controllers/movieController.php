<?php

class movieController
{
    private movie $movie;
    private image $image;

    public function __construct()
    {
        Login::JWT(true);
        $this->movie = new movie();
        $this->image = new image();
    }

    /**
     * get one movie
     * @param $id
     * @return void
     * @throws Exception
     */
    public function getOne($id): void
    {
        $movie = $this->movie;

        // Headers
        header('Access-Control-Allow-Origin:*');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: none');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        // get data
        $data = $movie->getRow($id);

        //output
        echo json_encode($data, JSON_THROW_ON_ERROR);
    }


    /**
     * get all movies
     * @return void
     * @throws Exception
     */
    public function getAll(): void
    {
        $movie = $this->movie;

        // Headers
        header('Access-Control-Allow-Origin:*');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: none');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        // get data
        $data = $movie->getAll();

        // output
        echo json_encode($data, JSON_THROW_ON_ERROR);
    }


    /**
     * insert movie
     * @return void
     * @throws Exception
     */
    public function insert(): void
    {
        // On interdit toute méthode qui n'est pas POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (_isset::post('libel', 'description', 'actors', 'date', 'genre', 'language', 'runeTime', 'Time', 'imdbRating')) {

                _validate::post();

                if (_isset::file('image') && _empty::file('image')) {

                    $movie = $this->movie;
                    $image = $this->image;

                    // Headers
                    header("Access-Control-Max-Age: 3600");
                    header('Access-Control-Allow-Origin: *');
                    header("Content-Type: application/json; charset=UTF-8");
                    header("Access-Control-Allow-Methods: POST");
                    header("Access-Control-Allow-Headers: Origin, Authorization, Content-Type, Access-Control-Allow-Origin");
                    http_response_code(200);

                    // start transaction
                    $movie->startTransaction();
                    $image->startTransaction();

                    // Get images posted data
                    $data = array(
                        'name' => $_FILES["image"]["name"],
                        'type' => $_FILES["image"]["type"],
                        'image' => file_get_contents(_validate::_string($_FILES["image"]["tmp_name"]))
                    );
                    // insert image
                    if ($image->insert($data)) {
                        // Get posted data
                        $data = array(
                            'DVD' => $_POST['DVD'],
                            'libel' => $_POST['libel'],
                            'genre' => $_POST['genre'],
                            'actors' => $_POST['category'],
                            'language' => $_POST['language'],
                            'runeTime' => $_POST['runeTime'],
                            'description' => $_POST['description'],
                            'image' => BURL . 'image/get/' . $image->getInsertId()
                        );
                        // insert data
                        if ($movie->insert($data)) {
                            $image->commit();
                            $movie->commit();
                            http_response_code(201);
                            echo json_encode(
                                array(
                                    'message' => 'movie Created',
                                    'status' => $_SERVER['REDIRECT_STATUS']
                                ),
                                JSON_THROW_ON_ERROR);
                        } else {
                            $image->rollback();
                            $movie->rollback();
                            http_response_code(500);
                            echo json_encode(
                                array(
                                    'message' => 'movie Not Created',
                                    'status' => $_SERVER['REDIRECT_STATUS']
                                ),
                                JSON_THROW_ON_ERROR);
                        }
                    } else {
                        $image->rollback();
                        http_response_code(415);
                        echo json_encode(
                            array(
                                'message' => 'movie Not Created',
                                'status' => $_SERVER['REDIRECT_STATUS']
                            ),
                            JSON_THROW_ON_ERROR);
                    }
                } else {
                    http_response_code(510);
                    echo json_encode(
                        array(
                            'message' => 'movie Not Created ( Image no exist )',
                            'status' => 504
                        ),
                        JSON_THROW_ON_ERROR);
                }
            } else {
                http_response_code(510);
                echo json_encode(
                    array(
                        'message' => 'movie Not Created something went wrong (error in data)',
                        'status' => 504
                    ),
                    JSON_THROW_ON_ERROR);
            }
        } else {
            http_response_code(405);
            echo json_encode(
                array(
                    'message' => 'Méthode non autorisée',
                    'status' => 405
                ),
                JSON_THROW_ON_ERROR);
        }
    }


    /**
     * update a movie
     * @return void
     * @throws Exception
     */
    public function update(): void
    {
        // On interdit toute méthode qui n'est pas POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (_isset::post('id') && _empty::post($_POST, 'id')) {

                $movie = $this->movie;
                $image = $this->image;

                // Headers
                header("Access-Control-Max-Age: 3600");
                header('Access-Control-Allow-Origin: *');
                header("Content-Type: application/json; charset=UTF-8");
                header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
                header("Access-Control-Allow-Headers: Origin, Authorization, Content-Type, Access-Control-Allow-Origin");
                http_response_code(200);

                _validate::post();
                $id = $_POST['id'];

                if ($movie->exists($id)) {

                    $data = _isset::post('libel') ? array_merge([], ['libel' => $_POST['libel']]) : [];
                    $data = _isset::post('category') ? array_merge($data, ['category' => $_POST['category']]) : $data;
                    $data = _isset::post('description') ? array_merge($data, ['description' => $_POST['description']]) : $data;

                    $flag = _isset::post('libel');
                    $flag = _isset::post('category') || $flag;
                    $flag = _isset::post('description') || $flag;

                    $isset_img = _isset::file('image') && _empty::file('image');

                    if ($flag || $isset_img) {

                        if ($flag && $isset_img) {
                            // start transaction
                            $movie->startTransaction();
                            $image->startTransaction();

                            // Get images data
                            $img = array(
                                'name' => $_FILES["image"]["name"],
                                'type' => $_FILES["image"]["type"],
                                'image' => file_get_contents(_validate::_string($_FILES["image"]["tmp_name"]))
                            );

                            $tmp = $movie->getRow($id)['image'];
                            $arr = explode('/', $tmp);
                            $id_img = (int)end($arr);

                            // update image
                            if ($image->update($id_img, $img)) {
                                // update data
                                if ($movie->update($id, $data)) {
                                    $image->commit();
                                    $movie->commit();
                                    http_response_code(201);
                                    echo json_encode(
                                        array(
                                            'message' => 'movie Created',
                                            'status' => $_SERVER['REDIRECT_STATUS']
                                        ),
                                        JSON_THROW_ON_ERROR);
                                } else {
                                    $image->rollback();
                                    $movie->rollback();
                                    http_response_code(500);
                                    echo json_encode(
                                        array(
                                            'message' => 'movie Not Created',
                                            'status' => $_SERVER['REDIRECT_STATUS']
                                        ),
                                        JSON_THROW_ON_ERROR);
                                }
                            } else {
                                $image->rollback();
                                http_response_code(415);
                                echo json_encode(
                                    array(
                                        'message' => 'movie Not updated ( error in update image )',
                                        'status' => $_SERVER['REDIRECT_STATUS']
                                    ),
                                    JSON_THROW_ON_ERROR);
                            }
                        } else if ($isset_img) {
                            // Get images data
                            $img = array(
                                'name' => $_FILES["image"]["name"],
                                'type' => $_FILES["image"]["type"],
                                'image' => file_get_contents(_validate::_string($_FILES["image"]["tmp_name"]))
                            );

                            $tmp = $movie->getRow($id)['image'];
                            $arr = explode('/', $tmp);
                            $id_img = (int)end($arr);

                            // update image
                            if ($image->update($id_img, $img)) {
                                http_response_code(201);
                                echo json_encode(
                                    array(
                                        'message' => 'image updated successfully',
                                        'status' => $_SERVER['REDIRECT_STATUS']
                                    ),
                                    JSON_THROW_ON_ERROR);
                            } else {
                                http_response_code(415);
                                echo json_encode(
                                    array(
                                        'message' => 'image Not updated',
                                        'status' => $_SERVER['REDIRECT_STATUS']
                                    ),
                                    JSON_THROW_ON_ERROR);
                            }
                        } else {
                            // update data
                            if ($movie->update($id, $data)) {
                                http_response_code(201);
                                echo json_encode(
                                    array(
                                        'message' => 'movie updated successfully',
                                        'status' => $_SERVER['REDIRECT_STATUS']
                                    ),
                                    JSON_THROW_ON_ERROR);
                            } else {
                                http_response_code(500);
                                echo json_encode(
                                    array(
                                        'message' => 'movie Not Created',
                                        'status' => $_SERVER['REDIRECT_STATUS']
                                    ),
                                    JSON_THROW_ON_ERROR);
                            }
                        }
                    } else {
                        http_response_code(401);
                        echo json_encode(
                            array(
                                'message' => 'Error ( No data for update )',
                                'status' => 401
                            ),
                            JSON_THROW_ON_ERROR);
                    }
                } else {
                    http_response_code(401);
                    echo json_encode(
                        array(
                            'message' => 'Error  ( movie not exist )',
                            'status' => 401
                        ),
                        JSON_THROW_ON_ERROR);
                }
            } else {
                http_response_code(401);
                echo json_encode(
                    array(
                        'message' => 'Error  ( No item for update )',
                        'status' => 401
                    ),
                    JSON_THROW_ON_ERROR);
            }
        } else {
            http_response_code(405);
            echo json_encode(
                array(
                    'message' => 'Méthode non autorisée',
                    'status' => 405
                ),
                JSON_THROW_ON_ERROR);
        }
    }


    /**
     * delete movie
     * @return void
     * @throws Exception
     */
    public function delete(): void
    {
        // On interdit toute méthode qui n'est pas DELETE
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

            // Headers
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/json');
            header('Access-Control-Allow-Methods: DELETE');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

            $_DELETE = (array)json_decode(file_get_contents("php://input"), false, 512, JSON_THROW_ON_ERROR);

            if (_isset::delete($_DELETE, 'id') && _empty::delete($_DELETE, 'id')) {

                $movie = $this->movie;
                $image = $this->image;

                _validate::arr($_DELETE);

                $id = $_DELETE['id'];

                if ($movie->exists($id)) {

                    // start transaction
                    $movie->startTransaction();
                    $image->startTransaction();

                    $tmp = $movie->getRow($id)['image'];
                    $arr = explode('/', $tmp);
                    $id_img = (int)end($arr);

                    // Delete movie
                    if ($image->delete($id_img)) {
                        if ($movie->delete($id)) {
                            $image->commit();
                            $movie->commit();
                            http_response_code(201);
                            echo json_encode(
                                array(
                                    'message' => 'movie deleted successfully',
                                    'status' => $_SERVER['REDIRECT_STATUS']
                                ),
                                JSON_THROW_ON_ERROR);
                        } else {
                            $image->rollback();
                            $movie->rollback();
                            http_response_code(500);
                            echo json_encode(
                                array(
                                    'message' => 'movie Not deleted',
                                    'status' => $_SERVER['REDIRECT_STATUS']
                                ),
                                JSON_THROW_ON_ERROR);
                        }
                    } else {
                        $image->rollback();
                        http_response_code(415);
                        echo json_encode(
                            array(
                                'message' => 'movie Not deleted ( error in delet image )',
                                'status' => $_SERVER['REDIRECT_STATUS']
                            ),
                            JSON_THROW_ON_ERROR);
                    }
                } else {
                    http_response_code(401);
                    echo json_encode(
                        array(
                            'message' => 'Error  ( movie not exist )',
                            'status' => 401
                        ),
                        JSON_THROW_ON_ERROR);
                }
            } else {
                http_response_code(401);
                echo json_encode(
                    array(
                        'message' => 'Error  ( No item for delete )',
                        'status' => 401
                    ),
                    JSON_THROW_ON_ERROR);
            }
        } else {
            http_response_code(405);
            echo json_encode(
                array(
                    'message' => 'Méthode non autorisée',
                    'status' => 405
                ),
                JSON_THROW_ON_ERROR);
        }
    }
}