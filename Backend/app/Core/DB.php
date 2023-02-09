<?php

class DB
{
    protected MysqliDb $db;
    protected string $table;

    /**
     * @return MysqliDb
     * @throws Exception
     */
    public function _connect(): MysqliDb
    {
        $this->db = new MysqliDb (HOST, USER, PASS, DBNAME);
        $this->db->connect();
        return $this->db;
    }

    public function _table($table): void
    {
        $this->table = $table;
    }


    /**
     * @return bool tue if data inserted successfully
     * @throws Exception
     */
    public function insert($data): bool
    {
        return $this->db->insert($this->table, $data);
    }


    /**
     * @return bool tue if row deleted successfully
     * @throws Exception
     */
    public function delete($id): bool
    {
        $db = $this->db->where('id', $id);
        return $db->delete($this->table);
    }


    /**
     * @return MysqliDb|array|string
     * @throws Exception
     */
    public function getAll(): MysqliDb|array|string
    {
        return $this->db->get($this->table);
    }


    /**
     * @param $id
     * @return array|string|null
     * @throws Exception
     */
    public function getRow($id, $row = 'id'): array|string|null
    {
        $db = $this->db->where($row, $id);
        return $db->getOne($this->table);
    }


    /**
     * @param $id
     * @param $data
     * @return bool tue if row updated successfully
     * @throws Exception
     */
    public function update($id, $data, $by = 'id'): bool
    {
        $db = $this->db->where($by, $id);
        return $db->update($this->table, $data);
    }


    /**
     * @return int number for Last inserted id
     * @throws Exception
     */
    public function getInsertId(): int
    {
        return $this->db->getInsertId();
    }


    /**
     * @return bool true if table exist
     * @throws Exception
     */
    public function exists($id, $row = 'id', $s = '='): bool
    {
        return (bool)$this->db->rawQuery("SELECT EXISTS(
                                                       SELECT * FROM 
                                                          {$this->table} 
                                                       WHERE 
                                                           `{$row}` {$s} '{$id}'
                                                       ) as rep;
                                        ")[0]['rep'];

    }

    /**
     * @return void
     * @throws Exception
     */
    public function startTransaction(): void
    {
        $this->db->startTransaction();
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function rollback(): bool
    {
        return $this->db->rollback();
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function commit(): bool
    {
        return $this->db->commit();
    }
}