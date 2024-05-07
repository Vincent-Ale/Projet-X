<?php

namespace App;

class Router {
    private $routes = [];

    public function register($method, $path, $callback) {
        $this->routes[$method][$path] = $callback;
    }

    public function dispatch($method, $uri) {
        foreach ($this->routes[$method] as $path => $callback) {
            if (preg_match($this->convertToRegex($path), $uri, $matches)) {
                return call_user_func_array($callback, array_slice($matches, 1));
            }
        }

        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
        exit;
    }

    private function convertToRegex($path) {
        return '/^' . str_replace('/', '\/', preg_replace('/\{[\w]+\}/', '([\w-]+)', $path)) . '$/';
    }
}