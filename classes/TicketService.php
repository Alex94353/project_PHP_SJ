<?php

require_once __DIR__ . '/Database.php';

class TicketService extends Database
{
    
    public function __construct() {
        parent::__construct(); 
    }

    public function create(array $data, array $file)
    {
        $path = __DIR__ . '/../uploads';

        if (!is_dir($path)) {
            mkdir($path);
        }

        $filename = uniqid('', true) . '-' . basename($file['name']);
        $filepath = $path . '/' . $filename;
        move_uploaded_file($file['tmp_name'], $filepath);

        $stmt = $this->connection->prepare("
            INSERT INTO tickets (title, description, image, tag_id, user_id)
            VALUES (:title, :description, :image, :tag_id, :user_id)
        ");

        return $stmt->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => "uploads/$filename",
            'tag_id' => $data['tag_id'],
            'user_id' => $data['user_id']
        ]);
    }

    public function getTicketById(int $id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM tickets WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $ticket = $stmt->fetch();

        return $ticket ?: null;
    }

    public function deleteTicket(int $id)
    {
        $stmt = $this->connection->prepare("DELETE FROM tickets WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function userCanManage(array $ticket, array $user, int $adminGroupId)
    {
        return $ticket['user_id'] === $user['id'] || (int)$user['group_id'] === $adminGroupId;
    }

    public function updateTag(int $ticketId, int $tagId)
    {
        $stmt = $this->connection->prepare("UPDATE tickets SET tag_id = :tag WHERE id = :id");
        $stmt->execute(['tag' => $tagId, 'id' => $ticketId]);
    }

    public function getUserTickets(int $userId)
    {
        $stmt = $this->connection->prepare("SELECT * FROM tickets WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function tagExists(int $tagId)
    {
        $stmt = $this->connection->prepare("SELECT id FROM ticket_tags WHERE id = :id");
        $stmt->execute(['id' => $tagId]);
        return (bool) $stmt->fetch();
    }

    public function getAllTickets()
    {
        $stmt = $this->connection->query("SELECT * FROM tickets");
        return $stmt->fetchAll();
    }

    public function search(string $query = '')
    {
        if ($query !== '') {
            $stmt = $this->connection->prepare("
                SELECT * FROM tickets
                WHERE title LIKE :query OR description LIKE :query
                ORDER BY id DESC
            ");
            $stmt->execute(['query' => '%' . $query . '%']);
            return $stmt->fetchAll();
        }

        return $this->getAllTickets();
    }

    public function getAllTags()
    {
        $stmt = $this->connection->query("SELECT * FROM ticket_tags");
        return $stmt->fetchAll();
    }
}
