<?php

use App\Controllers\View;
use App\Api\WikiApi;
use App\Api\CategoryApi;
use App\Api\TagApi;
use App\Api\WikiTagApi;
use App\Api\AuthApi;
use App\middlewares\AuthMiddleware;
use App\Router;
use App\Api\StatistiquesApi;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Api\picApi;


$router = new Router();

//rendering views routes

$router->get('/', View::class, 'index');
$router->get('/wiki', View::class, 'wiki');
$router->get('/contact', View::class, 'contact');
$router->get('/about', View::class, 'about');
$router->get('/register', View::class, 'register');
$router->get('/login', View::class, 'login');

$router->get('/wikis', View::class, 'wikis', AuthMiddleware::class, 'authorViews');
$router->get('/dashboard', View::class, 'dashboard', AuthMiddleware::class, 'adminViews');
$router->get('/crudwikis', View::class, 'crudwikis', AuthMiddleware::class, 'adminViews');
$router->get('/tags', View::class, 'tags', AuthMiddleware::class, 'adminViews');
$router->get('/categories', View::class, 'categories', AuthMiddleware::class, 'adminViews');

//APIs routes:

//wiki APIs

$router->get('/api/wikis/read', WikiApi::class, 'read');
$router->get('/api/wikis/get_id', WikiApi::class, 'get_id',);
$router->get('/api/wikis/load', WikiApi::class, 'loadsinglewiki');
//author
$router->get('/api/wikis/authorload', WikiApi::class, 'authorload', AuthMiddleware::class, 'authorAPI');
$router->post('/api/wikis', WikiApi::class, 'create', AuthMiddleware::class, 'authorAPI');
$router->delete('/api/wikis', WikiApi::class, 'delete', AuthMiddleware::class, 'authorAPI');
$router->put('/api/wikis', WikiApi::class, 'update', AuthMiddleware::class, 'authorAPI');
//admin
$router->get('/api/wikis/admin', WikiApi::class, 'adminload');
$router->patch('/api/wikis/archive', WikiApi::class, 'archive', AuthMiddleware::class, 'adminApis');
$router->patch('/api/wikis/desarchive', WikiApi::class, 'desarchive', AuthMiddleware::class, 'adminApis');


//catagory APIs

$router->get('/api/categorie/loadsinglecategory', CategoryApi::class, 'singlecategory');
$router->get('/api/categorie', CategoryApi::class, 'read', AuthMiddleware::class, 'authorAPI');
//admin
$router->post('/api/categorie', CategoryApi::class, 'create', AuthMiddleware::class, 'adminApis');
$router->delete('/api/categorie', CategoryApi::class, 'delete', AuthMiddleware::class, 'adminApis');
$router->put('/api/categorie', CategoryApi::class, 'update', AuthMiddleware::class, 'adminApis');

$router->post('/api/picture', picApi::class, 'upload');



//tags APIs

$router->get('/api/tag/load', TagApi::class, 'tagperwiki');
$router->get('/api/tag/loadsignletag', TagApi::class, 'singletag');
$router->get('/api/tag/', TagApi::class, 'loadtags', AuthMiddleware::class, 'authorAPI');
//admin
$router->delete('/api/tag/', TagApi::class, 'delete', AuthMiddleware::class, 'adminApis');
$router->post('/api/tag/', TagApi::class, 'add', AuthMiddleware::class, 'adminApis');
$router->put('/api/tag/', TagApi::class, 'update', AuthMiddleware::class, 'adminApis');


//wikitag APIs

$router->post('/api/Wikitag/', WikiTagApi::class, 'create');


//user APIs

$router->post('/api/user/login', AuthApi::class, 'login');
$router->post('/api/user/register', AuthApi::class, 'register');


//wikitag APIs

$router->get('/api/statistiques', StatistiquesApi::class, 'statistiques', AuthMiddleware::class, 'adminApis');

$router->dispatch();
