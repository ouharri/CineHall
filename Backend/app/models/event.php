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
     * @throws Exception
     */
    public function getDetailEvent($id)
    {
        return $this->db->rawQuery("SELECT ev.*,h.nbrPlace,m.image,m.libel,m.Time, m.description ,m.actors,  m.genre, m.date, m.Country, m.language, m.imdbRating, h.nbrPlace, h.numbre, h.numbre AS hallNumber ,ev.date as eventDate
                                    FROM 
                                        {$this->table} ev
                                    INNER JOIN 
                                        movie m
                                    ON 
                                        ev.movie = m.id
                                    INNER JOIN 
                                        halls h
                                    ON 
                                        ev.hall = h.id
                                    LEFT JOIN
                                        reservation r
                                    ON 
                                        ev.id = r.event
                                    WHERE 
                                        ev.id = {$id}
                                    GROUP BY 
                                        ev.id
                                    HAVING 
                                        COUNT(r.id) < h.nbrPlace
                                    Limit 1;
                                    ")[0];
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

    /**
     * @throws Exception
     */
    public function getAllEvents(): array|string
    {
        return $this->db->rawQuery("SELECT {$this->table}.* , m.image, m.libel, m.Time, m.description ,m.actors,  m.genre, m.date, m.Country, m.language, m.imdbRating, h.nbrPlace, h.numbre, h.numbre AS hallNumber ,{$this->table}.date as eventDate
                                    FROM
                                        {$this->table}
                                    INNER JOIN 
                                        movie m
                                    ON 
                                        {$this->table}.movie = m.id
                                    INNER JOIN
                                        halls h
                                    ON
                                        {$this->table}.hall = h.id
                                    where
                                        {$this->table}.date >= CURDATE()
                                    ORDER BY 
                                        {$this->table}.date ASC  
                                    ");
    }

    /**
     * @throws Exception
     */
    public function getAllEventsByDate($date): array|string
    {
        return $this->db->rawQuery("SELECT {$this->table}.* , m.image, m.libel, m.Time, m.description ,m.actors,  m.genre, m.date, m.Country, m.language, m.imdbRating, h.nbrPlace, h.numbre, h.numbre AS hallNumber ,{$this->table}.date as eventDate
                                    FROM
                                        {$this->table}
                                    INNER JOIN 
                                        movie m
                                    ON 
                                        {$this->table}.movie = m.id
                                    INNER JOIN
                                        halls h
                                    ON
                                        {$this->table}.hall = h.id
                                    LEFT JOIN
                                        reservation r
                                    ON 
                                        {$this->table}.id = r.event
                                    where
                                        {$this->table}.date = '{$date}'
                                    GROUP BY 
                                        {$this->table}.id
                                    HAVING 
                                        COUNT(r.id) < h.nbrPlace;
                                    ");
    }

    /**
     * @throws Exception
     */
    public function getMonthEvent(): array|string
    {
        return $this->db->rawQuery("SELECT m.libel,m.image, COUNT(r.id) as total_reservations,{$this->table}.id,m.genre
                                    FROM movie m
                                        INNER JOIN {$this->table} ON {$this->table}.movie = m.id
                                    INNER JOIN 
                                        reservation r 
                                    ON 
                                        {$this->table}.id = r.event
                                    INNER JOIN
                                        halls h
                                    ON
                                        {$this->table}.hall = h.id
                                    WHERE 
                                            MONTH({$this->table}.date) = MONTH(CURDATE())
                                    GROUP BY 
                                        m.id, h.nbrPlace
                                    HAVING 
                                        total_reservations < h.nbrPlace
                                    ORDER BY 
                                            total_reservations DESC   
                                    LIMIT 1;
                                    ")[0];
    }
}
