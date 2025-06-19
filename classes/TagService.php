<?php

require_once __DIR__ . '/Database.php';

class TagService extends Database
{
    
    public function __construct() {
        parent::__construct(); 
    }

    
    public function create(array $data)
    {
        
        if ($this->exists((int)$data['id'])) {
            return false; 
        }

        $stmt = $this->connection->prepare("
            INSERT INTO ticket_tags (id, label, background, color)
            VALUES (:id, :label, :background, :color)
        ");

        return $stmt->execute([
            'id' => $data['id'],
            'label' => $data['label'],
            'background' => $data['background'],
            'color' => $data['color']
        ]);
    }

    public function getAll()
    {
        $stmt = $this->connection->query("SELECT * FROM ticket_tags ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function getById(int $id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM ticket_tags WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $tag = $stmt->fetch();

        return $tag ?: null;
    }


    public function update(int $id, array $data)
    {
        $stmt = $this->connection->prepare("
            UPDATE ticket_tags
            SET label = :label,
                background = :background,
                color = :color
            WHERE id = :id
        ");

        return $stmt->execute([
            'id' => $id,
            'label' => $data['label'],
            'background' => $data['background'],
            'color' => $data['color']
        ]);
    }


    public function delete(int $id)
    {
        $stmt = $this->connection->prepare("DELETE FROM ticket_tags WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }


    public function exists(int $id)
    {
        $stmt = $this->connection->prepare("SELECT id FROM ticket_tags WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return (bool) $stmt->fetch();
    }
}
