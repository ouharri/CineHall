<?php

class hallsController
{
    private halls $halls;
    private image $image;

    public function __construct()
    {
        Login::JWT();
        $this->halls = new halls();
        $this->image = new image();
    }

    /**
     * @throws Exception
     */
    public function getOne($id): void
    {
        $halls = $this->halls;
        $image = $this->image;

        // Headers
        header('Access-Control-Allow-Origin:*');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: none');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        // get data
        $data = $halls->getRow($id);

        //output
        echo json_encode($data);
    }

    /**
     * @throws Exception
     */
    public function getAll(): void
    {
        $halls = $this->halls;
        $image = $this->image;

        // Headers
        header("Access-Control-Allow-Origin:*");
        header("Content-Type: application/json");
        header("Access-Control-Allow-Method: none");
        header("Access-Control-Allow-Headers: Authorization, Content-Type");
//        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation");

        // get data
        $data = $halls->getAll();

        // output
        echo json_encode($data);
    }

    /**
     * @throws Exception
     */
    public function insert(): void
    {
        // On interdit toute méthode qui n'est pas POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (_isset::post('libel', 'description', 'movie')) {

                $halls = $this->halls;
                $image = $this->image;

                // Headers
                header("Access-Control-Max-Age: 3600");
                header('Access-Control-Allow-Origin: *');
                header("Content-Type: application/json; charset=UTF-8");
                header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
                header("Access-Control-Allow-Headers: Origin, Authorization, Content-Type, Access-Control-Allow-Origin");
                http_response_code(200);

                // start transaction
                $halls->startTransaction();
                $image->startTransaction();

                // Get images posted data
                $data = array(
                    'name' => $_FILES["img"]["name"],
                    'type' => $_FILES["img"]["type"],
                    'image' => file_get_contents($_FILES["img"]["tmp_name"])
                );
                // insert image
                if ($image->insert($data)) {
                    // Get posted data
                    $data = array(
                        'libel' => $_POST['libel'],
                        'description' => $_POST['description'],
                        'movie' => $_POST['movie'],
                        'image' => BURL . 'image/get/' . $image->getInsertId()
                    );
                    // insert data
                    if ($halls->insert($data)) {
                        $image->commit();
                        $halls->commit();
                        http_response_code(201);
                        echo json_encode(
                            array(
                                'message' => 'halls Created',
                                'status' => $_SERVER['REDIRECT_STATUS']
                            )
                        );
                    } else {
                        $image->rollback();
                        $halls->rollback();
                        http_response_code(500);
                        echo json_encode(
                            array(
                                'message' => 'halls Not Created',
                                'status' => $_SERVER['REDIRECT_STATUS']
                            )
                        );
                    }
                } else {
                    $image->rollback();
                    http_response_code(415);
                    echo json_encode(
                        array(
                            'message' => 'halls Not Created',
                            'status' => $_SERVER['REDIRECT_STATUS']
                        )
                    );
                }
            } else {
                http_response_code(510);
                echo json_encode(
                    array(
                        'message' => 'halls Not Created something went wrong (error in data)',
                        'status' => 504
                    )
                );
            }
        } else {
            http_response_code(405);
            echo json_encode(
                array(
                    'message' => 'Méthode non autorisée',
                    'status' => 405
                )
            );
        }
    }

    /**
     * @throws Exception
     */
    public function update(): void
    {
        // On interdit toute méthode qui n'est pas POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (_isset::post('id')) {

                $halls = $this->halls;
                $image = $this->image;

                // Headers
                header("Access-Control-Max-Age: 3600");
                header('Access-Control-Allow-Origin: *');
                header("Content-Type: application/json; charset=UTF-8");
                header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
                header("Access-Control-Allow-Headers: Origin, Authorization, Content-Type, Access-Control-Allow-Origin");
                http_response_code(200);

                $id = $_POST['id'];

                $data = _isset::post('libel') ? array_merge([], ['libel' => $_POST['libel']]) : [];
                $data = _isset::post('movie') ? array_merge($data, ['movie' => $_POST['movie']]) : $data;
                $data = _isset::post('description') ? array_merge($data, ['description' => $_POST['description']]) : $data;

                $flag = _isset::post('libel');
                $flag = _isset::post('movie') || $flag;
                $flag = _isset::post('description') || $flag;

                $isset_img = _isset::file('image') && _empty::file('image');

                if ($flag || $isset_img) {

                    if ($flag && $isset_img) {
                        // start transaction
                        $halls->startTransaction();
                        $image->startTransaction();

                        // Get images data
                        $img = array(
                            'name' => $_FILES["image"]["name"],
                            'type' => $_FILES["image"]["type"],
                            'image' => file_get_contents($_FILES["image"]["tmp_name"])
                        );

                        $tmp = $halls->getRow($id)['image'];
                        $arr = explode('/', $tmp);
                        $id_img = (int)end($arr);

                        // update image
                        if ($image->update($id_img, $img)) {
                            // update data
                            if ($halls->update($id, $data)) {
                                $image->commit();
                                $halls->commit();
                                http_response_code(201);
                                echo json_encode(
                                    array(
                                        'message' => 'halls Created',
                                        'status' => $_SERVER['REDIRECT_STATUS']
                                    )
                                );
                            } else {
                                $image->rollback();
                                $halls->rollback();
                                http_response_code(500);
                                echo json_encode(
                                    array(
                                        'message' => 'halls Not Created',
                                        'status' => $_SERVER['REDIRECT_STATUS']
                                    )
                                );
                            }
                        } else {
                            $image->rollback();
                            http_response_code(415);
                            echo json_encode(
                                array(
                                    'message' => 'halls Not updated ( error in update image )',
                                    'status' => $_SERVER['REDIRECT_STATUS']
                                )
                            );
                        }
                    } else if ($isset_img) {
                        // Get images data
                        $img = array(
                            'name' => $_FILES["image"]["name"],
                            'type' => $_FILES["image"]["type"],
                            'image' => file_get_contents($_FILES["image"]["tmp_name"])
                        );

                        $tmp = $halls->getRow($id)['image'];
                        $arr = explode('/', $tmp);
                        $id_img = (int)end($arr);

                        // update image
                        if ($image->update($id_img, $img)) {
                            http_response_code(201);
                            echo json_encode(
                                array(
                                    'message' => 'image updated successfully',
                                    'status' => $_SERVER['REDIRECT_STATUS']
                                )
                            );
                        } else {
                            http_response_code(415);
                            echo json_encode(
                                array(
                                    'message' => 'image Not updated',
                                    'status' => $_SERVER['REDIRECT_STATUS']
                                )
                            );
                        }
                    } else {
                        // update data
                        if ($halls->update($id, $data)) {
                            http_response_code(201);
                            echo json_encode(
                                array(
                                    'message' => 'halls Created',
                                    'status' => $_SERVER['REDIRECT_STATUS']
                                )
                            );
                        } else {
                            http_response_code(500);
                            echo json_encode(
                                array(
                                    'message' => 'halls Not Created',
                                    'status' => $_SERVER['REDIRECT_STATUS']
                                )
                            );
                        }
                    }
                } else {
                    http_response_code(401);
                    echo json_encode(
                        array(
                            'message' => 'Error ( No data for update )',
                            'status' => 401
                        )
                    );
                }
            } else {
                http_response_code(401);
                echo json_encode(
                    array(
                        'message' => 'Error  ( No item for update )',
                        'status' => 401
                    )
                );
            }
        } else {
            http_response_code(405);
            echo json_encode(
                array(
                    'message' => 'Méthode non autorisée',
                    'status' => 405
                )
            );
        }
    }

    /**
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

            // $data = json_decode(file_get_contents("php://input"));
            parse_str(file_get_contents("php://input"), $_DELETE);

            if (_isset::delete($_DELETE, 'id')) {

                $halls = $this->halls;
                $image = $this->image;

                // Set ID to UPDATE
                $id = $_DELETE['id'];

                // start transaction
                $halls->startTransaction();
                $image->startTransaction();

                $tmp = $halls->getRow($id)['image'];
                $arr = explode('/', $tmp);
                $id_img = (int)end($arr);

                // Delete halls
                if ($image->delete($id_img)) {
                    if ($halls->delete($id)) {
                        $image->commit();
                        $halls->commit();
                        http_response_code(201);
                        echo json_encode(
                            array(
                                'message' => 'halls deleted successfully',
                                'status' => $_SERVER['REDIRECT_STATUS']
                            )
                        );
                    } else {
                        $image->rollback();
                        $halls->rollback();
                        http_response_code(500);
                        echo json_encode(
                            array(
                                'message' => 'halls Not deleted',
                                'status' => $_SERVER['REDIRECT_STATUS']
                            )
                        );
                    }
                } else {
                    $image->rollback();
                    http_response_code(415);
                    echo json_encode(
                        array(
                            'message' => 'halls Not deleted ( error in delet image )',
                            'status' => $_SERVER['REDIRECT_STATUS']
                        )
                    );
                }
            } else {
                http_response_code(401);
                echo json_encode(
                    array(
                        'message' => 'Error  ( No item for delete )',
                        'status' => 401
                    )
                );
            }
        } else {
            http_response_code(405);
            echo json_encode(
                array(
                    'message' => 'Méthode non autorisée',
                    'status' => 405
                )
            );
        }
    }
}