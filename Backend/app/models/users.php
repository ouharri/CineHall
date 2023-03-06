<?php


class users extends DB
{
    private string $First_Name;
    private string $Last_Name;
    private string $email;
    private string $img;
    private string $code;
    private bool $is_admin;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->_connect();
        $this->_table('users');
    }

    /**
     * @throws Exception
     */
    public function getUser($user, $password): MysqliDb|array|string|null
    {
        $admin = $this->db->where('email', $user);
        $admin = $this->db->where('password', $password);
        return $admin->getOne($this->table);
    }

    /**
     * @throws Exception
     */
    public function getRowByMail($mail): array|string|null
    {
        return $this->db->where('email', $mail)->getOne($this->table);
    }

    /**
     * @throws Exception
     */
    public function getRowByCode($code): array|string|null
    {
        return $this->db->where('code', $code)->getOne($this->table);
    }

    /**
     * @throws Exception
     */
    public function updateCode($code, $data): bool
    {
        return $this->db->where('code', $code)->update($this->table, $data);
    }

    /**
     * @throws Exception
     */
    public function updateByEmail($email, $data): bool
    {
        return $this->db->where('email', $email)->update($this->table, $data);
    }


    /**
     * @throws Exception
     */
    public function updateByCode($code, $data): bool
    {
        return $this->db->where('code', $code)->update($this->table, $data);
    }

    /**
     * @throws Exception
     */
    public function setAdmin($id): bool
    {
        return $this->db->where('id', $id)->update($this->table, ['is_admin' => true]);
    }

    /**
     * @throws Exception
     */
    public function setClient($id): bool
    {
        return $this->db->where('id', $id)->update($this->table, ['is_admin' => false]);
    }

    /**
     * @throws Exception
     */
    public function getRecent(): array|string
    {
        return $this->db->rawquery("SELECT * 
                                           FROM 
                                                {$this->table}
                                           WHERE
                                                is_admin != true
                                           ORDER BY id LIMIT 8;");
    }
}