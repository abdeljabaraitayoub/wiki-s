<?php

namespace App\middlewares;

use App\Controller;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware
{
    private $private_key = "secret-key";
    public function adminApis($Controller, $method)
    {
        if (isset($_COOKIE['AUTHORIZATION'])) {
            $data = JWT::decode($_COOKIE["AUTHORIZATION"], new Key($this->private_key, 'HS256'));
            if ($data->role == "admin") {
                $controller = new $Controller();
                $controller->$method();
            } else {
                header("HTTP/1.1 401 Unauthorized");
            }
        } else {
            header("HTTP/1.1 401 Unauthorized");
        }
    }
    public function adminViews($Controller, $method)
    {
        if (isset($_COOKIE['AUTHORIZATION'])) {
            $data = JWT::decode($_COOKIE["AUTHORIZATION"], new Key($this->private_key, 'HS256'));
            if ($data->role == "admin") {
                $controller = new $Controller();
                $controller->$method();
            } else {
                header("Location: /login");
            }
        } else {
            header("Location: /login");
        }
    }
    public function authorAPI($Controller, $method)
    {
        if (isset($_COOKIE['AUTHORIZATION'])) {
            $data = JWT::decode($_COOKIE["AUTHORIZATION"], new Key($this->private_key, 'HS256'));
            if ($data->role == "author" || $data->role == "admin") {
                $controller = new $Controller();
                $controller->$method();
            } else {
                header("HTTP/1.1 401 Unauthorized");
            }
        } else {
            header("HTTP/1.1 401 Unauthorized");
        }
    }
    public function authorViews($Controller, $method)
    {
        if (isset($_COOKIE['AUTHORIZATION'])) {
            $data = JWT::decode($_COOKIE["AUTHORIZATION"], new Key($this->private_key, 'HS256'));
            if ($data->role == "author" || $data->role == "admin") {
                $controller = new $Controller();
                $controller->$method();
            } else {
                header("HTTP/1.1 401 Unauthorized");
            }
        } else {
            header("HTTP/1.1 401 Unauthorized");
        }
    }
}
