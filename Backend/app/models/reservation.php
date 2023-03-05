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
        $this->_table('reservation');
    }

    public function getExist($user, $event)
    {
        return $this->db->rawQuery("SELECT r.seat AS seat
                                    FROM 
                                        {$this->table} r
                                    INNER JOIN 
                                        events e
                                    ON 
                                        r.event = e.id
                                    WHERE 
                                        e.id = {$event}
                                    AND
                                        r.user NOT LIKE '{$user}'
                                    ");
    }

    public function getUserExist($user, $event)
    {
        return $this->db->rawQuery("SELECT r.seat AS seat
                                    FROM 
                                        {$this->table} r
                                    INNER JOIN 
                                        events e
                                    ON 
                                        r.event = e.id
                                    WHERE 
                                        e.id = {$event}
                                    AND
                                        r.user LIKE '{$user}'
                                    ");
    }

    public function deleteReservation($user, $seat, $event)
    {
        $this->db->rawQuery("DELETE FROM {$this->table} 
                                    WHERE 
                                        user 
                                    LIKE 
                                        '{$user}' 
                                    AND 
                                        seat
                                    LIKE 
                                        '{$seat}' 
                                    AND 
                                        event 
                                    = {$event}
                                    ");

        return count(explode(" ", $this->db->getLastError()) )?true:false;
    }

    public function existSeat($event, $seat): bool
    {
        return (bool)$this->db->rawQuery("SELECT EXISTS(
                                             SELECT * FROM 
                                                          {$this->table} 
                                                       WHERE 
                                                           event = '{$event}'
                                                         AND
                                                            seat = '{$seat}'
                                                       ) as rep;
                                        ")[0]['rep'];
    }
}
