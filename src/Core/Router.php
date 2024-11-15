<?php

namespace Core;

use Exception;

class Router
{
    protected $routes = [];

    protected function add($route, $controller, $method, $middleware = null)
    {
        $this->routes[] = [
            "uri" =>  $route,
            "controller" => $controller,
            "method" => $method,
            "middleware" => $middleware
        ];
    }
    public function get($route, $controller)
    {
        $this->add($route, $controller, 'GET');
        return $this;
    }
    public function post($route, $controller)
    {
        $this->add($route, $controller, 'POST');
        return $this;
    }
    public function patch($route, $controller)
    {
        $this->add($route, $controller, 'PATCH');
        return $this;
    }
    public function put($route, $controller)
    {
        $this->add($route, $controller, 'PUT');
        return $this;
    }
    public function delete($route, $controller)
    {
        $this->add($route, $controller, 'DELETE');
        return $this;
    }

    public function only($middleware)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $middleware;
        return $this;
    }

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
