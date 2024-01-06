<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Journal;

class HomeController extends Controller
{
    public function index()
    {
        $this->render("/user/index");
    }

    public function wiki()
    {
        $this->render("/user/post");
    }
    public function contact()
    {
        $this->render("/user/contact");
    }
    public function about()
    {
        $this->render("/user/about");
    }
    public function insert()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = isset($_POST["username"]) ? $_POST["username"] : "";
            $email = isset($_POST["password"]) ? $_POST["password"] : "";
            $this->render('layout/home', ['name' => $name]);
        }
    }
}
