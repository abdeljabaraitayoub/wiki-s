<?php

namespace App\Api;

use App\Controller;
use App\Model\Wikitags;

class WikiTagApi
{
    public function create()
    {
        $jsonString = file_get_contents('php://input');
        $data = json_decode($jsonString, true);
        extract($data);
        $tag = new Wikitags();
        $tags = json_encode($tag->create($wikiID, $tagID));
    }
}
