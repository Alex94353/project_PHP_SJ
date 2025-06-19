<?php

require_once __DIR__ . '/Database.php';

class UserService extends Database
{
    
    public function __construct() {
        parent::__construct(); 
    }


    public function getAll()
    {
        $stmt = $this->connection->query("SELECT * FROM users ORDER BY id DESC");
        return $stmt->fetchAll();
    }


    public function getById(int $id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch();

        return $user ?: null;
    }


    public function update(int $id, array $data)
    {
        $stmt = $this->connection->prepare("
            UPDATE users
            SET email = :email,
                first_name = :first_name,
                last_name = :last_name,
                date_of_birth = :date_of_birth,
                group_id = :group_id
            WHERE id = :id
        ");

        return $stmt->execute([
            'id' => $id,
            'email' => $data['email'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'date_of_birth' => $data['date_of_birth'],
            'group_id' => $data['group_id']
        ]);
    }


    public function delete(int $id)
    {
        $stmt = $this->connection->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }


    public function exists(int $id)
    {
        $stmt = $this->connection->prepare("SELECT id FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return (bool) $stmt->fetch();
    }
}
