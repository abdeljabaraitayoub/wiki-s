<?php

use App\Controllers\HomeController;
use App\Router;

$router = new Router();
//rendering view routes
$router->get('/', HomeController::class, 'index');
$router->get('/wiki', HomeController::class, 'wiki');
$router->get('/contact', HomeController::class, 'contact');
$router->get('/about', HomeController::class, 'about');

$router->get('/user', HomeController::class, 'user');
$router->post('/insert', HomeController::class, 'insert');

$router->dispatch();
