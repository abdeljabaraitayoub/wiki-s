<?php

namespace App\Model;

use App\Model\database;

use PDO;

class Wikitags
{
    private $db;

    public function __construct()
    {
        $this->db = new database();
    }
    public function create($wikiID, $tagID)
    {
        $query = "insert into wikiTag (wikiID,tagID) values ($wikiID, $tagID)";
        $stmt = $this->db->query($query);
    }
}
