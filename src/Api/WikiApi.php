<?php

namespace App\Api;

use App\Controller;
use App\Model\Wiki;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class WikiApi
{
    public function read()
    {
        header('Content-Type: application/json; charset=utf-8');
        $wiki = new Wiki();
        $search = htmlspecialchars($_GET['search'] ?? '');
        $page = htmlspecialchars($_GET['page'] ?? 1);
        $itemsPerPage = htmlspecialchars($_GET['itemsPerPage'] ?? 5);
        $wikis = json_encode($wiki->read($search, $page, $itemsPerPage));
        echo $wikis;
    }

    public function loadsinglewiki()
    {
        header('Content-Type: application/json; charset=utf-8');
        extract($_GET);
        $id = htmlspecialchars($id);
        $wiki = new Wiki();
        $wikis = json_encode($wiki->loadsinglewiki($id));
        echo $wikis;
    }

    public function authorload()
    {
        header('Content-Type: application/json; charset=utf-8');
        $wiki = new Wiki();
        $data = JWT::decode($_COOKIE["AUTHORIZATION"], new Key("secret-key", 'HS256'));
        $id = htmlspecialchars($data->id);
        $wikis = json_encode($wiki->authorload($id));
        echo $wikis;
    }

    public function adminload()
    {
        header('Content-Type: application/json; charset=utf-8');
        extract($_GET);
        $wiki = new Wiki();
        $wikis = json_encode($wiki->admin());
        echo $wikis;
    }

    public function get_id()
    {
        header('Content-Type: application/json; charset=utf-8');
        extract($_GET);
        $wiki = new Wiki();
        $title = htmlspecialchars($title);
        $wikis = json_encode($wiki->get_id($title));
        echo $wikis;
    }

    public function create()
    {
        $jsonString = file_get_contents('php://input');
        $data = json_decode($jsonString, true);
        extract($data);
        $title = htmlspecialchars($title);
        $description = htmlspecialchars($description);
        $content = htmlspecialchars($content);
        $categorie = htmlspecialchars($categorie);
        $wiki = new Wiki();
        $data = JWT::decode($_COOKIE["AUTHORIZATION"], new Key("secret-key", 'HS256'));
        $id = htmlspecialchars($data->id);
        $wiki->create($title, $description, $content, $categorie, $id);
    }

    public function delete()
    {
        header('Content-Type: application/json; charset=utf-8');
        $jsonString = file_get_contents('php://input');
        $data = json_decode($jsonString, true);
        extract($data);
        $id = htmlspecialchars($id);
        $wiki = new Wiki();
        $wiki->delete($id);
    }

    public function update()
    {
        header('Content-Type: application/json; charset=utf-8');
        $jsonString = file_get_contents('php://input');
        $data = json_decode($jsonString, true);
        extract($data);
        $id = htmlspecialchars($id);
        $title = htmlspecialchars($title);
        $description = htmlspecialchars($description);
        $content = htmlspecialchars($content);
        $categorie = htmlspecialchars($categorie);
        $wiki = new Wiki();
        $wiki->update($id, $title, $description, $content, $categorie);
    }

    public function archive()
    {
        header('Content-Type: application/json; charset=utf-8');
        $jsonString = file_get_contents('php://input');
        $data = json_decode($jsonString, true);
        extract($data);
        $id = htmlspecialchars($id);
        $wiki = new Wiki();
        $wiki->archive($id);
    }

    public function desarchive()
    {
        header('Content-Type: application/json; charset=utf-8');
        $jsonString = file_get_contents('php://input');
        $data = json_decode($jsonString, true);
        extract($data);
        $id = htmlspecialchars($id);
        $wiki = new Wiki();
        $wiki->desarchive($id);
    }
}
