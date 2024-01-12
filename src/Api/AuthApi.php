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
        header('Content-Type: application/json; charset=utf-8');
        $jsonString = file_get_contents('php://input');
        $private_key = "secret-key";

        $data = json_decode($jsonString, true);
        extract($data);

        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);

        $user = new user();
        $users = $user->login($email);
        $usersjson = json_encode($users);

        if (empty($users)) {
            header("HTTP/1.1 401 Unauthorized");
            echo json_encode('wrong email');
        } else if (password_verify($password, $users[0]['password'])) {
            header('Content-Type: application/json; charset=utf-8');

            $payload = array(
                "iat" => 1356999524,
                "nbf" => 1357000000,
                "role" => $users[0]['Role'],
                "id" => $users[0]['id'],
            );

            $token = JWT::encode($payload, $private_key, 'HS256');
            $response = ["jwt" => $token, "role" => $users[0]['Role']];

            echo json_encode($response);
        } else {
            header("HTTP/1.1 401 Unauthorized");
            echo json_encode('wrong password');
        }
    }

    public function register()
    {
        header('Content-Type: application/json; charset=utf-8');
        $jsonString = file_get_contents('php://input');
        $data = json_decode($jsonString, true);
        extract($data);

        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);
        $username = htmlspecialchars($username);

        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
        $user = new user();
        $usersjson = json_encode($user->register($email, $hashedpassword, $username));
    }
}
