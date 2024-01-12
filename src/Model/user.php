<?php

namespace App\Model;

use App\Model\database;

use PDO;

class user
{
    private $db;

    public function __construct()
    {
        $this->db = new database();
    }
    public function login($email)
    {
        $query = "SELECT * FROM users WHERE email = '$email'";
        $stmt = $this->db->query($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
    public function register($email, $password, $username)
    {
        $query = "INSERT INTO users (email, password, username) VALUES ('$email', '$password', '$username')";
        $stmt = $this->db->query($query);
        return $stmt;
    }
    public function statistiques()
    {
        $query = "SELECT COUNT(*) as total FROM users";
        $stmt = $this->db->query($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
}
