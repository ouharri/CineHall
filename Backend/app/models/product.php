<?php

class product extends DB
{

    /**
     * @throws Exception
     */

    public function __construct()
    {
        $this->_connect();
        $this->_table('products');
    }

    /**
     * @throws Exception
     */
    public function SortBy($by, $order, $key): array|string
    {
        return $this->db->rawquery("SELECT " . "
                                        *
                                    FROM
                                        {$this->table}
                                    where 
                                        libel LIKE '%{$key}%'
                                    ORDER BY
                                        `{$by}` {$order};");
    }

    /**
     * @throws Exception
     */
    public function search($key): array|string
    {
        return $this->db->rawquery("SELECT " . " *
                                            FROM
                                                {$this->table}
                                            WHERE
                                                libel LIKE '%{$key}%';");
    }

    /**
     * @throws Exception
     */
    public function getRecent(): array|string
    {
        return $this->db->rawquery("SELECT  * 
                                           FROM 
                                                {$this->table} 
                                           ORDER BY `id` LIMIT 8;");
    }

    /**
     * @throws Exception
     */
    public function getTotal(): array|string
    {
        return $this->db->rawquery("SELECT " . " count(*) as total
                                           FROM 
                                                {$this->table} 
                                           ")[0]['total'];
    }

    /**
     * @throws Exception
     */
    public function getMax()
    {
        return $this->db->rawquery("SELECT " . " max(price) as max
                                           FROM 
                                                {$this->table} 
                                           ")[0]['max'];
    }

    /**
     * @throws Exception
     */
    public function getMin()
    {
        return $this->db->rawquery("SELECT " . " min(price) as min
                                           FROM 
                                                {$this->table} 
                                           ")[0]['min'];
    }

    /**
     * @throws Exception
     */
    public function getAvg()
    {
        return $this->db->rawquery("SELECT " . " AVG(price) as avg
                                           FROM 
                                                {$this->table} 
                                           ")[0]['avg'];
    }
}