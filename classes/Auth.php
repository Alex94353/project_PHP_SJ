<?php
require_once __DIR__ . '/Database.php';

class Auth extends Database
{

    public function __construct()
    {
        parent::__construct(); 
    }

    public function authenticate(string $email, string $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $statement = $this->connection->prepare($sql);

        try {
            $result = $statement->execute(['email' => $email]);
            $user = $statement->fetch();

            if (!$user || !password_verify($password, $user['password'])) {
                return false;
            }
            session_start();
            $_SESSION['user'] = $user['id'];
            return true;
        } catch (Exception $e) {
            echo 'Chyba: ' . $e->getMessage();
            return false;
        }
    }

    public function logout()
    {
        session_start();
        unset($_SESSION['user']);
        session_destroy();
    }

    public static function user()
    {
        static $cachedUser = null;

        if ($cachedUser !== null) {
            return $cachedUser;
        }
        
        if (!isset($_SESSION['user'])) {
            return null;
        }

        $db = (new self())->getConnection();

        $sql = "SELECT * FROM users WHERE id = :id";
        $statement = $db->prepare($sql);
        $statement->execute(['id' => $_SESSION['user']]);
        $user = $statement->fetch();

        $cachedUser = $user ?: null;
        return $cachedUser;
    }

    public static function isRole(int $role)
    {
        $user = self::user();
        return $user && (int)$user['group_id'] === $role;
    }
}