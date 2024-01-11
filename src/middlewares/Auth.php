<?php

namespace App\middlewares;

use App\Controller;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth
{
    public function handle($Controller, $method)
    {
        // dump($_COOKIE["AUTHORIZATION"]);
        $private_key = "secret-key";
        if (isset($_COOKIE['AUTHORIZATION'])) {

            $data = JWT::decode($_COOKIE["AUTHORIZATION"], new Key("secret-key", 'HS256'));
            // dump($data);
            // echo $data->role;
            if ($data->role == "admin") {
                $controller = new $Controller();
                $controller->$method();
                // echo "mr7ba";
            } else {
                header("location:/");
                // echo "7yed mn hna";
            }
        } else {
            header("location:/");
            // echo "7yed mn hna";
        }
    }
}
