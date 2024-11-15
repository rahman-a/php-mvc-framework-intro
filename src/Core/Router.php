<?php

namespace Core;

use Exception;
use Core\Middleware\Middleware;

class Router
{
    protected $routes = [];

    protected function add($uri, $controller, $method, $middleware = null)
    {
        $this->routes[] = [
            "uri" =>  $uri,
            "controller" => $controller,
            "method" => $method,
            "middleware" => $middleware
        ];
    }
    public function get($uri, $controller)
    {
        $this->add($uri, $controller, 'GET');
        return $this;
    }
    public function post($uri, $controller)
    {
        $this->add($uri, $controller, 'POST');
        return $this;
    }
    public function patch($uri, $controller)
    {
        $this->add($uri, $controller, 'PATCH');
        return $this;
    }
    public function put($uri, $controller)
    {
        $this->add($uri, $controller, 'PUT');
        return $this;
    }
    public function delete($uri, $controller)
    {
        $this->add($uri, $controller, 'DELETE');
        return $this;
    }

    public function only($middleware)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $middleware;
        return $this;
    }

    // for test purpose
    public function getRoutes()
    {
        return $this->routes;
    }

    public function route()
    {
        $method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

        $uri = parse_url($_SERVER["REQUEST_URI"])["path"];

        foreach ($this->routes as $route) {

            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {

                Middleware::resolve($route['middleware']);

                if (is_string($route['controller'])) {

                    return require base_path("src/Http/controllers/" . $route['controller']);
                }

                return call_user_func($route['controller']);
            }
        }

        throw new Exception('No route matched your request');
    }
}
