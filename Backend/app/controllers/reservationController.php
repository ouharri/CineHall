<?php

class reservationController
{
    private image $image;
    private reservation $reservation;

    public function __construct()
    {
        $this->image = new image();
        $this->reservation = new reservation();
    }

    /**
     * @throws Exception
     */
    public function getOne($id): void
    {
        $image = $this->image;
        $reservation = $this->reservation;

        // Headers
        header('Access-Control-Allow-Origin:*');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: none');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        // get data
        $data = $reservation->getRow($id);

        //output
        echo json_encode($data);
    }

    /**
     * @throws Exception
     */
    public function getAll(): void
    {
        $image = $this->image;
        $reservation = $this->reservation;

        // Headers
        header('Access-Control-Allow-Origin:*');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: none');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        // get data
        $data = $reservation->getAll();

        // output
        echo json_encode($data);
    }

    /**
     * @throws Exception
     */
    public function insert(): void
    {
        $image = $this->image;
        $reservation = $this->reservation;

        // Headers
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

        // Get raw posted data
        $data = (array)json_decode(file_get_contents("php://input"));

        // insert data
        if ($reservation->insert($data)) {
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
        $image = $this->image;
        $reservation = $this->reservation;

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
        if ($reservation->update($id, $data)) {
            echo json_encode(
                array(
                    'message' => 'halls Updated',
                    'status' => $_SERVER['REDIRECT_STATUS']??''
                )
            );
        } else {
            echo json_encode(
                array(
                    'message' => 'halls not updated',
                    'status' => $_SERVER['REDIRECT_STATUS']??''
                )
            );
        }
    }

    /**
     * @throws Exception
     */
    public function delet(): void
    {
        $image = $this->image;
        $reservation = $this->reservation;

        // Headers
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: DELETE');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"));

        // Set ID to delet
        $id = $data->id;

        // Delete halls
        if ($reservation->delete($id)) {
            echo json_encode(
                array(
                    'message' => 'movie deleted',
                    'status' => $_SERVER['REDIRECT_STATUS']??''
                )
            );
        } else {
            echo json_encode(
                array(
                    'message' => 'movie not deleted',
                    'status' => $_SERVER['REDIRECT_STATUS']??''
                )
            );
        }
    }
}