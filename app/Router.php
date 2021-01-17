<?php

namespace App\App;

use Exception;

class Router
{
    protected $routes = [];

    public static function load(string $file)
    {
        $router = new static();
        require $file;

        return $router;
    }

    public function get($uri, $controller)
    {
        $this->request($uri, 'GET', $controller);
    }

    public function post($uri, $controller)
    {
        $this->request($uri, 'POST', $controller);
    }

    public function put($uri, $controller)
    {
        $this->request($uri, 'PUT', $controller);
    }

    public function delete($uri, $controller)
    {
        $this->request($uri, 'DELETE', $controller);
    }

    private function request(string $url, string $method, $action)
    {
        if (preg_match_all('/({([a-zA-Z]+)})/', $url, $params)) {
            $url = preg_replace('/({([a-zA-Z]+)})/', '(.+)', $url);
        }

        $url = str_replace('/', '\/', $url);

        $route = [
            'url' => $url,
            'method' => $method,
            'action' => $action,
            'params' => $params[2]
        ];
        array_push($this->routes, $route);
    }

    public function direct(string $url, string $method)
    {
        try {
            foreach ($this->routes as $key => $route) {
                if ($route['method'] == $method) {
                    $reg = '/^' . $route['url'] . '$/';
                    if (preg_match($reg, $url, $params)) {
                        array_shift($params);
                        return $this->callAction($route['action'], $params);
                    }
                }
            }
        } catch (Exception $e) {
            return null;
        }

        return null;
    }

    protected function callAction($action, $params)
    {
        if (is_callable($action)) {
            return call_user_func_array($action, $params);
        }

        if (is_string($action)) {
            $action = explode('@', $action);
            $Controller = 'App\\Controllers\\' . $action[0];
            $controller = new $Controller();

            if (!method_exists($controller, $action[1])) {
                throw new Exception("{$controller} does not have {$action}");
            }

            return call_user_func_array([$controller, $action[1]], $params);
        }

        return null;
    }
}
