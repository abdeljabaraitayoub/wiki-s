<?php

namespace App\Model;

use App\Model\database;

use PDO;

class Category
{
    private $db;

    public function __construct()
    {
        $this->db = new database();
    }
    public function read()
    {
        $query = "SELECT * FROM categories";
        $stmt = $this->db->query($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        // dump($stmt->fetchAll());
        return $stmt->fetchAll();
    }
    public function create($title)
    {
        $query = "INSERT INTO categories (title) VALUES ('$title')";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    }
    public function delete($id)
    {
        $query = "DELETE FROM categories WHERE id = '$id'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    }
    public function update($id, $title)
    {
        $query = "UPDATE categories SET title = '$title'WHERE id = '$id'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    }
}
