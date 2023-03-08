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
                                    INNER JOIN
                                        reservation r
                                    ON 
                                        ev.id = r.event
                                    WHERE 
                                        ev.id = {$id}
                                    GROUP BY 
                                        ev.id
                                    HAVING 
                                        COUNT(r.id) < h.nbrPlace;
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
                                    INNER JOIN
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
}
