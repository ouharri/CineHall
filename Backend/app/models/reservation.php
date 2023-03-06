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

    /**
     * @throws Exception
     */
    public function getExist($user, $event): array|string
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

    /**
     * @throws Exception
     */
    public function getUserExist($user, $event): array|string
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

    /**
     * @throws Exception
     */
    public function deleteReservation($user, $seat, $event): bool
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

        return (bool)count(explode(" ", $this->db->getLastError()));
    }

    /**
     * @throws Exception
     */
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
