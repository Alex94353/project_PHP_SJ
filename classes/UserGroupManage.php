<?php

require_once __DIR__ . '/Database.php';

class UserGroupManage extends Database
{
    protected $connection;

    public function __construct()
    {
        $this->connect();
        $this->connection = $this->getConnection();
    }

    
    public function create(array $data)
    {
        if ($this->exists((int)$data['id'])) {
            return false; 
        }

        $stmt = $this->connection->prepare("
            INSERT INTO user_groups (id, label)
            VALUES (:id, :label)
        ");

        return $stmt->execute([
            'id' => $data['id'],
            'label' => $data['label']
        ]);
    }

    
    public function getAll()
    {
        $stmt = $this->connection->query("SELECT * FROM user_groups ORDER BY id ASC");
        return $stmt->fetchAll();
    }

    
    public function getById(int $id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM user_groups WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $group = $stmt->fetch();

        return $group ?: null;
    }

    
    public function update(int $oldId, array $data)
    {
    
        if ($oldId !== (int)$data['id']) {
            
            $stmt = $this->connection->prepare("
                UPDATE user_groups
                SET id = :new_id,
                    label = :label,
                    updated_at = CURRENT_TIMESTAMP
                WHERE id = :old_id
            ");

            return $stmt->execute([
                'new_id' => $data['id'],
                'label' => $data['label'],
                'old_id' => $oldId
            ]);
        } else {
            
            $stmt = $this->connection->prepare("
                UPDATE user_groups
                SET label = :label,
                    updated_at = CURRENT_TIMESTAMP
                WHERE id = :id
            ");

            return $stmt->execute([
                'id' => $oldId,
                'label' => $data['label']
            ]);
        }
    }


    
    public function delete(int $id)
    {
        $stmt = $this->connection->prepare("DELETE FROM user_groups WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    
    public function exists(int $id)
    {
        $stmt = $this->connection->prepare("SELECT id FROM user_groups WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return (bool) $stmt->fetch();
    }
}
