<?php

namespace App\Api;

use App\Controller;
use App\Model\Category;

class CategoryApi
{
    public function read()
    {
        header('Content-Type: application/json');
        $wiki = new Category();
        $wikis = json_encode($wiki->read());
        echo $wikis;
        // dump($wikis);
    }
    public function create()
    {
        $jsonString = file_get_contents('php://input');
        $data = json_decode($jsonString, true);
        // dump($data);

        extract($data);
        $title = htmlspecialchars($title);
        $wiki = new Category();
        $wiki->create($title);
    }
    public function delete()
    {
        $jsonString = file_get_contents('php://input');
        $data = json_decode($jsonString, true);
        // dump($data);

        extract($data);
        $id = htmlspecialchars($id);
        $wiki = new Category();
        $wiki->delete($id);
    }
    public function update()
    {
        $jsonString = file_get_contents('php://input');
        $data = json_decode($jsonString, true);
        // dump($data);

        extract($data);
        $id = htmlspecialchars($id);
        $title = htmlspecialchars($title);
        $wiki = new Category();
        $wiki->update($id, $title);
    }
    public function singlecategory()
    {
        header('Content-Type: application/json');
        extract($_GET);
        // dump($data);
        $id = htmlspecialchars($id);
        $wiki = new Category();
        $wiki->loadsinglecategory($id);
        echo json_encode($wiki->loadsinglecategory($id));
    }
}
