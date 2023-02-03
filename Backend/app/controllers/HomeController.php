<?php

class HomeController
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
//        echo "<img width=500px src='" . url('Home/image/3') . "' />";
//        View::load('users/Home');
    }

    /**
     * @throws Exception
     */
    public function add(): void
    {
        $images = new image();
        $product = new Product();

        $product->startTransaction();
        $images->startTransaction();

        $data = array(
            'name' => $_FILES["img"]["name"],
            'size' => $_FILES["img"]["size"],
            'type' => $_FILES["img"]["type"],
            'image' => validate::_blob(file_get_contents($_FILES["img"]["tmp_name"]))
        );

        if ($images->insert($data)) {
            $data = array(
                'name' => $_POST["name"],
                'img' => $images->getInsertId()
            );
            if ( $product->insert($data) ) {
                $images->commit();
                $product->commit();
            } else {
                $images->rollback();
                $product->rollback();
            }
        }
        view::load('users/Home');
    }

    /**
     * @throws Exception
     */
    public function image($id): void
    {
        $images = new image();
        $data = $images->getRow($id);

        $image = "data:";
        $image .= $data['type'];
        $image .= ";charset=utf8;base64,";
        $image .= base64_encode($data['image']);

        header('Expires: 0');
        header('Pragma: public');
        header("Content-Type: {$data['type']}");
        header('Access-Control-Allow-Origin: *');
        header('Content-Transfer-Encoding: binary');
        header('Content-Description: File Transfer');
        header("Content-Disposition: Inline; filename={$data['name']}");
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        ob_clean();
        flush();
        readfile($image);
    }
}