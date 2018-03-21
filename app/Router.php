<?php

namespace App;

class Router
{
    private $url;
    private $routes = [];
    private $namedRoutes = [];

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function get($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'GET');
    }

    public function post($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'POST');
    }

    private function add($path, $callable, $name, $method)
    {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if(is_string($callable) && $name === null) {
            $name = $callable;
        }
        if($name) {
            $this->namedRoutes[$name] = $route;
        }
        return $route;
    }

    /**
     * @return mixed
     * @throws RouterException
     */
    public function run()
    {
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            throw new RouterException("REQUEST_METHOD does not exist");
        }

        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            /** @var Route $route */
            if($route->match($this->url)) {
                return $route->call();
            }
        }

        throw new RouterException("No matching routes");
    }

    /**
     * @param $name
     * @param array $params
     * @return mixed
     * @throws RouterException
     */
    public function url($name, $params = [])
    {
        if(!isset($this->namedRoutes[$name])) {
            throw new RouterException("No route matches this name");
        }

        return $this->namedRoutes[$name]->getUrl($params);
    }


}