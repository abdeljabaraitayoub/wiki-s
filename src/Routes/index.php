<?php



use App\Controllers\HomeController;
use App\Api\WikiApi;
use App\Api\CategoryApi;
use App\Api\TagApi;
use App\Api\WikiTagApi;
use App\Api\AuthApi;
use App\middlewares\Auth;
use App\Router;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


$router = new Router();
//rendering views routes
$router->get('/', HomeController::class, 'index');
$router->get('/wiki', HomeController::class, 'wiki');
$router->get('/contact', HomeController::class, 'contact');
$router->get('/about', HomeController::class, 'about');
$router->get('/createWiki', HomeController::class, 'createWiki');
$router->get('/wikis', HomeController::class, 'wikis');
$router->get('/tags', HomeController::class, 'tags');
$router->get('/categories', HomeController::class, 'categories');

//APIs routes:

//wiki APIs
$router->get('/api/wikis/read', WikiApi::class, 'read');
$router->get('/api/wikis/get_id', WikiApi::class, 'get_id');
$router->get('/api/wikis/load', WikiApi::class, 'loadsinglewiki');
$router->get('/api/wikis/authorload', WikiApi::class, 'authorload');
$router->post('/api/wikis', WikiApi::class, 'create');
$router->delete('/api/wikis', WikiApi::class, 'delete');
$router->put('/api/wikis', WikiApi::class, 'update');
$router->patch('/api/wikis', WikiApi::class, 'archive');
//catagory APIs
$router->get('/api/categorie', CategoryApi::class, 'read');
$router->get('/api/categorie/loadsinglecategory', CategoryApi::class, 'singlecategory');
$router->post('/api/categorie', CategoryApi::class, 'create', Auth::class);
$router->delete('/api/categorie', CategoryApi::class, 'delete', Auth::class);
$router->put('/api/categorie', CategoryApi::class, 'update', Auth::class);
//tags APIs
$router->get('/api/tag/load', TagApi::class, 'tagperwiki');
$router->get('/api/tag/loadsignletag', TagApi::class, 'singletag');
$router->get('/api/tag/', TagApi::class, 'loadtags');
$router->delete('/api/tag/', TagApi::class, 'delete', Auth::class);
$router->post('/api/tag/', TagApi::class, 'add', Auth::class);
$router->put('/api/tag/', TagApi::class, 'update', Auth::class);
//wikitag APIs
$router->post('/api/Wikitag/', WikiTagApi::class, 'create');


//user APIs
$router->post('/api/user/login', AuthApi::class, 'login');
$router->post('/api/user/register', AuthApi::class, 'register');


$router->get('/user', HomeController::class, 'user');
$router->post('/insert', HomeController::class, 'insert');

$router->dispatch();
