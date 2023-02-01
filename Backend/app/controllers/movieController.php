<?php

class movieController
{
    private movie $movie;
    private image $image;

    public function __construct()
    {
        $this->movie = new movie();
        $this->image = new image();
    }

    /**
     * @throws Exception
     */
    public function getOne($id): void
    {
        $movie = $this->movie;
        $image = $this->image;

        // Headers
        header('Access-Control-Allow-Origin:*');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: none');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        // get data
        $data = $movie->getRow($id);

        //output
        echo json_encode($data);
    }

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
        echo json_encode($data);
    }

    /**
     * @throws Exception
     */
    public function insert(): void
    {
        $movie = $this->movie;
        $image = $this->image;

        // Headers
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

        // Get raw posted data
        $data = (array)json_decode(file_get_contents("php://input"));

        // insert data
        if ($movie->insert($data)) {
            echo json_encode(
                array(
                    'message' => 'halls Created',
                    'status' => $_SERVER['REDIRECT_STATUS']
                )
            );
        } else {
            echo json_encode(
                array(
                    'message' => 'halls Not Created',
                    'status' => $_SERVER['REDIRECT_STATUS']
                )
            );
        }
    }

    /**
     * @throws Exception
     */
    public function update(): void
    {
        $movie = $this->movie;
        $image = $this->image;

        // Headers
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: PUT');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"));

        // Set ID to UPDATE
        $id = $data->id;

        // Update halls
        if ($movie->update($id, $data)) {
            echo json_encode(
                array(
                    'message' => 'halls Updated',
                    'status' => $_SERVER['REDIRECT_STATUS']
                )
            );
        } else {
            echo json_encode(
                array(
                    'message' => 'halls not updated',
                    'status' => $_SERVER['REDIRECT_STATUS']
                )
            );
        }
    }

    /**
     * @throws Exception
     */
    public function delet(): void
    {
        $movie = $this->movie;
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
        if ($movie->delete($id)) {
            echo json_encode(
                array(
                    'message' => 'movie deleted',
                    'status' => $_SERVER['REDIRECT_STATUS']
                )
            );
        } else {
            echo json_encode(
                array(
                    'message' => 'movie not deleted',
                    'status' => $_SERVER['REDIRECT_STATUS']
                )
            );
        }
    }
}