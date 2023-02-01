<?php

class image extends DB
{
    private string $name;
    private string $type;
    private string $image;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->_connect();
        $this->_table('images');
    }

}