<?php

namespace App\Model;

use App\Model\database;

use PDO;

class tag
{
    private $db;

    public function __construct()
    {
        $this->db = new database();
    }
    public function tagsperwiki($id)
    {
        $query = "SELECT Nom FROM wikiTag join tags on wikiTag.tagID=tags.id WHERE wikiID = '$id'";
        $stmt = $this->db->query($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
    public function loadtags()
    {
        $query = "SELECT * FROM tags";
        $stmt = $this->db->query($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
    public function deletetag($id)
    {
        $query = "DELETE FROM tags WHERE id = '$id'";
        $stmt = $this->db->query($query);
        $stmt->execute();
    }
    public function loadsingltag($id)
    {
        $query = "SELECT * FROM tags WHERE id = '$id'";
        $stmt = $this->db->query($query);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
    public function updatetag($id, $title)
    {
        $query = "UPDATE tags SET Nom = '$title' WHERE id = '$id'";
        $stmt = $this->db->query($query);
    }
    public function addtag($title)
    {
        $query = "INSERT INTO tags (Nom) VALUES ('$title')";
        $stmt = $this->db->query($query);
    }
    public function statistiques()
    {
        $query = "SELECT COUNT(*) as total FROM tags";
        $stmt = $this->db->query($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
}
