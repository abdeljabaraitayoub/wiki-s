<?php

namespace App\Api;

use App\Controller;
use App\Model\Category;
use App\Model\Wiki;
use App\Model\tag;
use App\Model\user;

class StatistiquesApi
{
    public function statistiques()
    {
        header('Content-Type: application/json; charset=utf-8');
        $statistiques = [];
        //users
        $user = new user();
        $user = ($user->statistiques());
        $statistiques['user'] = $user[0]['total'];
        //wikis
        $wiki = new Wiki();
        $wiki = ($wiki->statistiques());
        $statistiques['wiki'] = $wiki[0]['total'];
        //categories
        $category = new Category();
        $category = ($category->statistiques());
        $statistiques['category'] = $category[0]['total'];
        //tags
        $tags = new Tag();
        $tags = ($tags->statistiques());
        $statistiques['tags'] = $tags[0]['total'];

        echo json_encode($statistiques);
    }
}
