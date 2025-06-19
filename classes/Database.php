<?php
require_once __DIR__ . '/../config/Settings.php';


class Database
{
    protected $connection;

    public function __construct()
    {
        $this->connect();
    }

    protected function connect()
    {
        $config = Settings::DATABASE; 
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $this->connection = new PDO(
                'mysql:host=' . $config['HOST'] .
                ';dbname=' . $config['DBNAME'] .
                ';port=' . $config['PORT'],
                $config['USER_NAME'],
                $config['PASSWORD'],
                $options
            );
        } catch (PDOException $e) {
            die('Chyba pripojenia: ' . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->connection;

    }
}
