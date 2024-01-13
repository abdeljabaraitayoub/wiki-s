<?php

namespace App\Model;

use App\Model\database;

use PDO;

class Wiki
{
    private $db;

    public function __construct()
    {
        $this->db = new database();
    }
    public function read($search, $page = 1, $itemsPerPage = 5)
    {
        $offset = ($page - 1) * $itemsPerPage;

        $query = "SELECT *, wikis.id as wikiID,wikis.title as title FROM wikis 
        JOIN users ON wikis.authorID = users.id left join categories on wikis.CategorieID = categories.id
        WHERE (wikis.title LIKE '%$search%' 
          OR description LIKE '%$search%'  OR categories.title LIKE '%$search%' 
          OR content LIKE '%$search%')
          AND DeleteDate IS NULL 
        LIMIT $itemsPerPage OFFSET $offset";

        $stmt = $this->db->query($query);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt->fetchAll();
    }
    public function loadsinglewiki($id)
    {
        $query = "SELECT * , wikis.id as wikiID FROM wikis 
        JOIN users ON wikis.authorID = users.id 
        WHERE wikis.id = $id ";

        $stmt = $this->db->query($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
    public function authorload($id)
    {
        $query = "SELECT * , wikis.id as wikiID FROM wikis 
        JOIN users ON wikis.authorID = users.id 
        WHERE  users.id  = $id ";
        $stmt = $this->db->query($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
    public function admin()
    {
        $query = "SELECT * , wikis.id as wikiID FROM wikis 
        JOIN users ON wikis.authorID = users.id ";
        $stmt = $this->db->query($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
    public function get_id($title)
    {
        $query = "SELECT wikis.id as wikiID FROM wikis 
        JOIN users ON wikis.authorID = users.id 
        WHERE wikis.title = '$title'  order by wikis.id desc limit 1";

        $stmt = $this->db->query($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    public function create($title, $description, $content, $categorie, $id)
    {

        $query = "INSERT INTO wikis (title,description,content,authorID,CategorieID) VALUES ('$title','$description','$content','$id','$categorie')";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    }
    public function delete($id)
    {
        $query = "DELETE FROM wikis WHERE id = '$id'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    }
    public function update($id, $title, $description, $content, $categorie)
    {
        $query = "UPDATE wikis SET title = '$title', description = '$description', content = '$content', CategorieID = '$categorie' WHERE id = '$id'";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
    }
    public function archive($id)
    {
        $query = "UPDATE wikis SET DeleteDate = current_timestamp() WHERE id = $id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    }
    public function desarchive($id)
    {
        $query = "UPDATE wikis SET DeleteDate = null WHERE id = $id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    }
    public function statistiques()
    {
        $query = "SELECT COUNT(*) as total FROM wikis";
        $stmt = $this->db->query($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
    public function imageupload($id, $path)
    {
        $query = "UPDATE wikis SET image = '$path' WHERE id = '$id'";
        $stmt = $this->db->prepare($query);
        dump($query);
        $stmt->execute();
    }
}
