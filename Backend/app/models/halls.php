<?php

class halls extends DB
{
    private string $libel;
    private string $description;
    private string $img;
    private string $movie;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->_connect();
        $this->_table('halls');
    }
}