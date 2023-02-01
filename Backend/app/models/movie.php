<?php

class movie extends DB
{
    private string $libel;
    private string $description;
    private string $img;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->_connect();
        $this->_table('images');
    }
}