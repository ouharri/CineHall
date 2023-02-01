<?php
require_once(LIBS . 'DB/MysqliDb.php');

class DB
{
    protected MysqliDb $db;
    protected string $table;


    /**
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
     * @throws Exception
     */
    public function insert($data): bool
    {
        return $this->db->insert($this->table, $data);
    }

    /**
     * @throws Exception
     */
    public function delete($id): bool
    {
        $db = $this->db->where('id', $id);
        return $db->delete($this->table);
    }

    /**
     * @throws Exception
     */
    public function getAll(): MysqliDb|array|string
    {
        return $this->db->get($this->table);
    }

    /**
     * @throws Exception
     */
    public function getRow($id): array|string|null
    {
        $db = $this->db->where('id', $id);
        return $db->getOne($this->table);
    }

    /**
     * @throws Exception
     */
    public function update($id, $data): bool
    {
        $db = $this->db->where('id', $id);
        return $db->update($this->table, $data);
    }

    public function getInsertId(): int
    {
        return $this->db->getInsertId();
    }

    /**
     * @throws Exception
     */
    public function startTransaction(): void
    {
        $this->db->startTransaction();
    }

    /**
     * @throws Exception
     */
    public function rollback(): bool
    {
        return $this->db->rollback();
    }

    /**
     * @throws Exception
     */
    public function commit(): bool
    {
        return $this->db->commit();
    }
}