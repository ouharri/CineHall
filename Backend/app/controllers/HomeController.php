<?php

class HomeController
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
        echo "<img width=500px src='" . url('Home/image/3') . "' />";
        View::load('users/Home');
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

        header('Access-Control-Allow-Origin: *');
        header("Content-Type: {$data['type']}");
        header("Content-Disposition: Inline; filename={$data['name']}");

        readfile($image);
    }
}