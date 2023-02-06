<?php

class event extends DB
{
    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->_connect();
        $this->_table('events');
    }

    /**
     * @return bool true when event exists
     * @throws Exception
     */
    public function existsEvent($id, $date, $hall): bool
    {
        return (bool)$this->db->rawQuery("SELECT EXISTS( SELECT *
                                                            FROM {$this->table}
                                                        WHERE
                                                            `date` = '{$date}'
                                                        AND 
                                                            hall = {$hall}
                                                        AND
                                                            id != '{$id}'
                                                        ) AS rep;
                                        ")[0]['rep'];

    }
}