<?php

require_once __DIR__ . '/Database.php';


class Register extends Database {
    
    public function __construct() {
        parent::__construct(); 
    }

    public function registerUser($email, $firstName, $lastName, $dateOfBirth, $password, $accessLevel) {
        $sql = "INSERT INTO users (email, first_name, last_name, date_of_birth, password, group_id)
                VALUES (:email, :first_name, :last_name, :date_of_birth, :password, :group_id)";
        $this->connection->beginTransaction();

        try {
            $statement = $this->connection->prepare($sql);
            $insert = $statement->execute([
                ':email' => $email,
                ':first_name' => $firstName,
                ':last_name' => $lastName,
                ':date_of_birth' => $dateOfBirth,
                ':password' => password_hash($password, PASSWORD_BCRYPT),
                ':group_id' => $accessLevel
            ]);

            $this->connection->commit();
            http_response_code(200);
            return $insert;
        } catch (Exception $e) {
            $this->connection->rollBack();
            http_response_code(500);
            error_log('Register error: ' . $e->getMessage());
            return false;
        }
    }
}

