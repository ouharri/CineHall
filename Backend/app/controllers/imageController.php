
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
    public function get($id): void
    {
        $image = $this->image;

        // get data image
        $data = $image->getRow($id);

        // header
        header('Expires: 0');
        header('Pragma: public');
        header("Content-Type: {$data['type']}");
        header('Access-Control-Allow-Origin: *');
        header('Content-Transfer-Encoding: binary');
        header('Content-Description: File Transfer');
        header("Content-Disposition: Inline; filename={$data['name']}");
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');

        $file = "data:";
        $file .= $data['type'];
        $file .= ";charset=utf8;base64,";
        $file .= base64_encode($data['image']);

        ob_clean();
        flush();

        readfile($file);
    }

}