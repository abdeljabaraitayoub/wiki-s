<?php

namespace App;

use App\Middleware\LoginMiddleware;

class Router
{
    protected $routes = [];

    private function addRoute($route, $controller, $action, $method, $Middleware, $MiddlewareMethode)
    {

        $this->routes[$method][$route] = ['controller' => $controller, 'action' => $action, 'Middleware' => $Middleware, 'MiddlewareMethode' => $MiddlewareMethode];
        // dump($this->routes);
    }
    public function get($route, $controller, $action, $Middleware = null, $MiddlewareMethode = null)
    {
        $this->addRoute($route, $controller, $action, "GET", $Middleware, $MiddlewareMethode);
    }

    public function post($route, $controller, $action, $Middleware = null, $MiddlewareMethode = null)
    {
        $this->addRoute($route, $controller, $action, "POST", $Middleware, $MiddlewareMethode);
    }
    public function put($route, $controller, $action, $Middleware = null, $MiddlewareMethode = null)
    {
        $this->addRoute($route, $controller, $action, "PUT", $Middleware, $MiddlewareMethode);
    }
    public function delete($route, $controller, $action, $Middleware = null, $MiddlewareMethode = null)
    {
        $this->addRoute($route, $controller, $action, "DELETE", $Middleware, $MiddlewareMethode);
    }
    public function patch($route, $controller, $action, $Middleware = null, $MiddlewareMethode = null)
    {
        $this->addRoute($route, $controller, $action, "PATCH", $Middleware, $MiddlewareMethode);
    }

    public function dispatch()
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $method =  $_SERVER['REQUEST_METHOD'];

        if (array_key_exists($uri, $this->routes[$method])) {
            $controller = $this->routes[$method][$uri]['controller'];
            $action = $this->routes[$method][$uri]['action'];

            if ($this->routes[$method][$uri]['Middleware'] == null) {
                $controller = new $controller();
                $controller->$action();
            } else {
                $midlleware = $this->routes[$method][$uri]['Middleware'];
                $MiddlewareMethode = $this->routes[$method][$uri]['MiddlewareMethode'];
                $midllewares = new $midlleware();
                $midllewares->$MiddlewareMethode($controller, $action);
            }
        } else {
            throw new \Exception("No route found for URI: $uri");
        }
    }
}
