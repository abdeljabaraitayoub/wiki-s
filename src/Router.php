<?php

namespace App;

use App\Middleware\LoginMiddleware;

class Router
{
    protected $routes = [];

    private function addRoute($route, $controller, $action, $method, $Middleware)
    {

        $this->routes[$method][$route] = ['controller' => $controller, 'action' => $action, 'Middleware' => $Middleware];
        // dump($this->routes);
    }
    public function get($route, $controller, $action, $Middleware = null)
    {
        $this->addRoute($route, $controller, $action, "GET", $Middleware);
    }

    public function post($route, $controller, $action, $Middleware = null)
    {
        $this->addRoute($route, $controller, $action, "POST", $Middleware);
    }
    public function put($route, $controller, $action, $Middleware = null)
    {
        $this->addRoute($route, $controller, $action, "PUT", $Middleware);
    }
    public function delete($route, $controller, $action, $Middleware = null)
    {
        $this->addRoute($route, $controller, $action, "DELETE", $Middleware);
    }
    public function patch($route, $controller, $action, $Middleware = null)
    {
        $this->addRoute($route, $controller, $action, "PATCH", $Middleware);
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
                $midllewares = new $midlleware();
                $midllewares->handle($controller, $action);
            }
        } else {
            throw new \Exception("No route found for URI: $uri");
        }
    }
}
