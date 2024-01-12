<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Journal;

class View extends Controller
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
    public function user()
    {
        $this->render("/user");
    }
    public function createWiki()
    {
        $this->render("admin/createwiki");
    }
    public function wikis()
    {
        $this->render("author/wikis");
    }
    public function crudwikis()
    {
        $this->render("admin/wikis");
    }
    public function tags()
    {
        $this->render("admin/tags");
    }
    public function categories()
    {
        $this->render("admin/category");
    }
    public function register()
    {
        $this->render("admin/register");
    }
    public function login()
    {
        $this->render("admin/login");
    }
    public function dashboard()
    {
        $this->render("admin/dashboard");
    }
}
