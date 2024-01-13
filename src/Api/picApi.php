<?php

namespace App\Api;

use App\Model\Wiki;

class picApi
{
    public function upload()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['pic'])) {
                $file = $_FILES['pic'];
                dump($file);
                $uploadDir = '../public/assets/img/';
                $filename = uniqid() . '_' . $file['name'];
                if (move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
                    echo 'File uploaded successfully.';
                }
            }
            $id = $_POST['id'];
            $path = "assets/img/" . $filename;
            $wiki = new Wiki();
            $wiki->imageupload($id, $path);
        }
    }
}
