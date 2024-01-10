<?php

namespace App\Api;

use App\Controller;
use App\Model\Wiki;

class WikiApi
{
    public function read()
    {
        header('Content-Type: application/json; charset=utf-8');
        $wiki = new Wiki();
        // dump($wiki->read($_GET['search'] ?? '', $_GET['page'] ?? 1, $_GET['itemsPerPage'] ?? 5));
        $wikis = json_encode($wiki->read($_GET['search'] ?? '', $_GET['page'] ?? 1, $_GET['itemsPerPage'] ?? 5));
        echo $wikis;
        // dump($wikis);
    }
    public function loadsinglewiki()
    {
        header('Content-Type: application/json; charset=utf-8');
        extract($_GET);
        $wiki = new Wiki();
        $wikis = json_encode($wiki->loadsinglewiki($id));
        echo $wikis;
    }
    public function authorload()
    {
        header('Content-Type: application/json; charset=utf-8');
        extract($_GET);
        $wiki = new Wiki();
        $wikis = json_encode($wiki->authorload($id));
        echo $wikis;
    }
    public function get_id()
    {
        header('Content-Type: application/json; charset=utf-8');
        extract($_GET);
        $wiki = new Wiki();
        $wikis = json_encode($wiki->get_id($title));
        echo $wikis;
    }
    public function create()
    {
        $jsonString = file_get_contents('php://input');
        // dump($jsonString);
        $data = json_decode($jsonString, true);
        // dump($data);
        extract($data);
        $wiki = new Wiki();
        $wiki->create($title, $description, $content, $categorie, $id);
    }
    public function delete()
    {
        header('Content-Type: application/json; charset=utf-8');
        $jsonString = file_get_contents('php://input');
        $data = json_decode($jsonString, true);
        // dump($data);

        extract($data);
        // echo ($id);
        // echo  json_encode($data);
        $wiki = new Wiki();
        $wiki->delete($id);
    }
    public function update()
    {
        header('Content-Type: application/json; charset=utf-8');
        $jsonString = file_get_contents('php://input');
        $data = json_decode($jsonString, true);
        // dump($data);

        extract($data);
        // echo ($id);
        // echo ($title);
        // echo ($description);
        // echo ($content);
        // echo ($categorie);
        // echo  json_encode($data);
        $wiki = new Wiki();
        $wiki->update($id, $title, $description, $content, $categorie);
    }
}
