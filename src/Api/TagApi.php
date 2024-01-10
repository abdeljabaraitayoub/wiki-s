<?php

namespace App\Api;

use App\Controller;
use App\Model\tag;

class TagApi
{
    public function loadtags()
    {
        extract($_GET);
        $tag = new tag();
        $tags = json_encode($tag->loadtags());
        echo $tags;
    }
    public function loadsingletag()
    {
        extract($_GET);
        $tag = new tag();
        $tags = json_encode($tag->loadsingltag($id));
        echo $tags;
    }
}
