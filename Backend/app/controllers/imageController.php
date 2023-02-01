
<?php

class imageController
{
    private image $image;

    public function __construct()
    {
        $this->image = new image();
    }

    /**
     * @throws Exception
     */
    public function getOne($id): void
    {
        $image = $this->image;

        // get image data
        $data = $image->getRow($id);

        // Headers
        header("Content-Type: {$data['type']}");
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Method: none');
        header("Content-Disposition: Inline; filename={$data['name']}");
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        //set image file
        $image = "data:";
        $image .= $data['type'];
        $image .= ";charset=utf8;base64,";
        $image .= base64_encode($data['image']);

        //output;
        readfile($image);
    }

}