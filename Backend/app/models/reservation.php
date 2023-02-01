<?php

class reservation extends DB
{

    private string $user;
    private string $movie;
    private string $hall;
    private string $seat;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->_connect();
        $this->_table('images');
    }
}