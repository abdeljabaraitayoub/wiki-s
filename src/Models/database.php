<?php

namespace App\Model;

use PDO;
use PDOException;

class Database
{
    private $host = 'localhost';
    private $dbname = 'wiki';
    private $username = 'root';
    private $password = '1223';
    private $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    public function query($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function prepare($query)
    {
        return $this->conn->prepare($query);
    }
}
