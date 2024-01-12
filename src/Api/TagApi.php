<?php

namespace App\Api;

use App\Controller;
use App\Model\tag;

class TagApi
{
    public function loadtags()
    {
        header('Content-Type: application/json; charset=utf-8');
        extract($_GET);
        $tag = new tag();
        $tags = json_encode($tag->loadtags());
        echo $tags;
    }
    public function tagperwiki()
    {
        header('Content-Type: application/json; charset=utf-8');
        $jsonString = file_get_contents('php://input');
        extract($_GET);
        $tag = new tag();
        $tags = json_encode($tag->tagsperwiki(htmlspecialchars($id)));
        echo $tags;
    }
    public function delete()
    {
        header('Content-Type: application/json; charset=utf-8');
        $jsonString = file_get_contents('php://input');
        $data = json_decode($jsonString, true);
        extract($data);
        $tag = new tag();
        $tag->deletetag(htmlspecialchars($id));
    }
    public function singletag()
    {
        header('Content-Type: application/json; charset=utf-8');
        extract($_GET);
        $tag = new tag();
        $tags = json_encode($tag->loadsingltag(htmlspecialchars($id)));
        echo $tags;
    }
    public function update()
    {
        header('Content-Type: application/json; charset=utf-8');
        $jsonString = file_get_contents('php://input');
        $data = json_decode($jsonString, true);
        extract($data);
        $tag = new tag();
        $tag->updatetag(htmlspecialchars($id), htmlspecialchars($title));
    }
    public function add()
    {
        header('Content-Type: application/json; charset=utf-8');
        $jsonString = file_get_contents('php://input');
        $data = json_decode($jsonString, true);
        extract($data);
        $tag = new tag();
        $tag->addtag(htmlspecialchars($title));
    }
}
