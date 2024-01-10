<?php

use App\Controllers\HomeController;
use App\Api\WikiApi;
use App\Api\CategoryApi;
use App\Api\TagApi;
use App\Api\WikiTagApi;
use App\Router;

$router = new Router();
//rendering views routes
$router->get('/', HomeController::class, 'index');
$router->get('/wiki', HomeController::class, 'wiki');
$router->get('/contact', HomeController::class, 'contact');
$router->get('/about', HomeController::class, 'about');
$router->get('/createWiki', HomeController::class, 'createWiki');
$router->get('/wikis', HomeController::class, 'wikis');
$router->get('/tags', HomeController::class, 'tags');

//APIs routes:

//wiki APIs
$router->get('/api/wikis/read', WikiApi::class, 'read');
$router->get('/api/wikis/get_id', WikiApi::class, 'get_id');
$router->get('/api/wikis/load', WikiApi::class, 'loadsinglewiki');
$router->get('/api/wikis/authorload', WikiApi::class, 'authorload');
$router->post('/api/wikis', WikiApi::class, 'create');
$router->delete('/api/wikis', WikiApi::class, 'delete');
$router->put('/api/wikis', WikiApi::class, 'update');
//catagory APIs
$router->get('/api/categorie', CategoryApi::class, 'read');
$router->post('/api/categorie/create', CategoryApi::class, 'create');
$router->post('/api/categorie/delete', CategoryApi::class, 'delete');
$router->post('/api/categorie/update', CategoryApi::class, 'update');
//catagory APIs
$router->get('/api/tag/load', TagApi::class, 'tagperwiki');
$router->get('/api/tag/loadsignletag', TagApi::class, 'singletag');
$router->get('/api/tag/', TagApi::class, 'loadtags');
$router->delete('/api/tag/', TagApi::class, 'delete');
//wikitag APIs
$router->post('/api/Wikitag/', WikiTagApi::class, 'create');


$router->get('/user', HomeController::class, 'user');
$router->post('/insert', HomeController::class, 'insert');

$router->dispatch();
