<?php

namespace App\Api;

use App\Controller;
use App\Model\user;

class AuthApi
{
    public function login()
    {
        header('Content-Type: application/json; charset=utf-8');
        $jsonString = file_get_contents('php://input');
        $data = json_decode($jsonString, true);
        extract($data);
        $user = new user();
        $users = $user->login($email, $password);
        $usersjson = json_encode($users);
        if (password_verify($password, $users[0]['password'])) {
            echo $usersjson;
        } else {
            echo json_encode('wrong password');
        }
    }
    public function register()
    {
        header('Content-Type: application/json; charset=utf-8');
        $jsonString = file_get_contents('php://input');
        $data = json_decode($jsonString, true);
        extract($data);
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
        $user = new user();
        $users = json_encode($user->register($email, $hashedpassword, $username));
        echo $users;
    }
}
