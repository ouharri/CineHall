<?php

class tmp
{
    public function tmp(){
        $halls = $this->halls;
        $image = $this->image;

        // Headers
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: PUT');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

        // Get raw posted data
        parse_str(file_get_contents("php://input"),$_PUT);
//        $data = json_decode($_PUT,true);
        $data = array(
            'libel' => $_PUT['libel'],
            'description' => $_PUT['description'],
            'movie' => $_PUT['movie'],
            'image' => BURL . 'image/get/' . $image->getInsertId()
        );
        debug($data);

        // Set ID to UPDATE
        $id = $data->id;

        // Update halls
        if ($halls->update($id, $data)) {
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
}