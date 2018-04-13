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

    /**
     * Create a GET route
     * @param $path
     * @param $callable
     * @param null $name
     * @return Route
     */
    public function get($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'GET');
    }

    /**
     * Create a POST route
     * @param $path
     * @param $callable
     * @param null $name
     * @return Route
     */
    public function post($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'POST');
    }

    /**
     * Create a route object and add it in a table sorted by methods (GET, POST).
     * Create the named route and return the route object.
     * @param $path
     * @param $callable
     * @param $name
     * @param $method
     * @return Route
     */
    private function add($path, $callable, $name, $method)
    {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if (is_string($callable) && $name === null) {
            $name = $callable;
        }
        if ($name) {
            $this->namedRoutes[$name] = $route;
        }
        return $route;
    }

    /**
     *  Scroll through the route table and call the route that matches the URL
     * @return mixed
     * @throws RouterException
     */
    public function run()
    {
        if (!isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            throw new RouterException("REQUEST_METHOD does not exist");
        }

        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            /** @var Route $route */
            if ($route->match($this->url)) {
                return $route->call();
            }
        }

        return header("Location: /");
    }
}