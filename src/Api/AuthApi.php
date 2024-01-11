<?php

namespace App\Api;

use App\Controller;
use App\Model\user;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthApi
{
    public function login()
    {
        $private_key = "secret-key";
        header('Content-Type: application/json; charset=utf-8');
        $jsonString = file_get_contents('php://input');
        $data = json_decode($jsonString, true);
        extract($data);
        $user = new user();
        $users = $user->login($email);
        $usersjson = json_encode($users);
        if (empty($users)) {
            echo json_encode('wrong email');
        } else if (password_verify($password, $users[0]['password'])) {
            // dump($users[0]);
            $payload = array(
                "iat" => 1356999524,
                "nbf" => 1357000000,
                "role" => $users[0]['Role'],
                "id" => $users[0]['id'],
            );

            $jwt = JWT::encode($payload, $private_key, 'HS256');
            echo $jwt;
        } else {
            echo json_encode('wrong password');
        }


        // $decoded = JWT::decode($_COOKIE["AUTHORIZATION"], new Key("secret-key", 'HS256'));
        // dump($decoded);
        // $decoded = JWT::decode($_SERVER['HTTP_AUTHORIZATION'], new Key("secret-key", 'HS256'));
    }
    public function register()
    {
        header('Content-Type: application/json; charset=utf-8');
        $jsonString = file_get_contents('php://input');
        $data = json_decode($jsonString, true);
        extract($data);
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
        $user = new user();
        $usersjson = json_encode($user->register($email, $hashedpassword, $username));
    }
}
