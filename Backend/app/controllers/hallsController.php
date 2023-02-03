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
//parse_str(file_get_contents("php://input"), $_PUT);
//debug($_FILES);

//if (_isset::put($_PUT, 'libel', 'description', 'movie')) {
    /**
     * @throws Exception
     */
    public function update(): void
    {
        // On interdit toute méthode qui n'est pas POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if ( _isset::post('id') ) {

                $halls = $this->halls;
                $image = $this->image;

                // Headers
                header("Access-Control-Max-Age: 3600");
                header('Access-Control-Allow-Origin: *');
                header("Content-Type: application/json; charset=UTF-8");
                header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
                header("Access-Control-Allow-Headers: Origin, Authorization, Content-Type, Access-Control-Allow-Origin");
                http_response_code(200);

                $data = array();
                $id = (int)$_POST['id'];

                $data = _isset::post('libel') ? array_merge($data, ['libel' => $_POST['libel']]) : $data;
                $data = _isset::post('movie') ? array_merge($data, ['movie' => $_POST['movie']]) : $data;
                $data = _isset::post('description') ? array_merge($data, ['description' => $_POST['description']]) : $data;

                if ( _isset::file('image') && _empty::file('image') ) {

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
                    if ( $image->update($id_img,$img) ) {

                        // update data
                        if ($halls->update($id,$data)) {
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
                    // update data
                    if ($halls->update($id,$data)) {
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
                        'message' => 'Error',
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
        public
        function delet(): void
        {
            $halls = $this->halls;
            $image = $this->image;

            // Headers
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/json');
            header('Access-Control-Allow-Methods: DELETE');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

            // Get raw posted data
            $data = json_decode(file_get_contents("php://input"));

            // Set ID to UPDATE
            $id = $data->id;

            // Delete halls
            if ($halls->delete($id)) {
                echo json_encode(
                    array(
                        'message' => 'Category deleted',
                        'status' => $_SERVER['REDIRECT_STATUS']
                    )
                );
            } else {
                echo json_encode(
                    array(
                        'message' => 'Category not deleted',
                        'status' => $_SERVER['REDIRECT_STATUS']
                    )
                );
            }
        }
    }