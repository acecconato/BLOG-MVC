<?php

namespace App;

class Route
{
    private $path;
    private $callable;
    private $matches = [];
    private $params = [];

    public function __construct($path, $callable)
    {
        $this->path = trim($path, "/");
        $this->callable = $callable;
    }

    /**
     * Filters parameters with REGEX and then returns the object.
     * @param $param
     * @param $regex
     * @return $this
     */
    public function with($param, $regex)
    {
        $this->params[$param] = str_replace('(', '(?:', $regex);
        return $this;
    }

    /**
     * Check if the URL matches a defined route.
     * @param $url
     * @return bool
     */
    public function match($url)
    {
        $url = trim($url, "/");
        $path = preg_replace_callback("#:([\w]+)#", [$this, 'paramMatch'], $this->path);
        $regex = "#^$path$#i";

        if(!preg_match($regex, $url, $matches)) {
            return false;
        }

        array_shift($matches);
        $this->matches = $matches;
        return true;
    }

    /**
     * Check if there is a parameter in the route.
     * @param $match
     * @return string
     */
    private function paramMatch($match)
    {
        if(isset($this->params[$match[1]])) {
            return '('. $this->params[$match[1]] . ')';
        }

        return "([^/]+)";
    }

    /**
     * Call the controller and the method attached to the route.
     * @return mixed
     */
    public function call()
    {
        if(!is_string($this->callable)) {
            return call_user_func_array($this->callable, $this->matches);
        }

        $params = explode("#", $this->callable);
        $controller = "\\Controller\\" . $params[0] . "Controller";
        $controller = new $controller();
        return call_user_func_array([$controller, $params[1]], $this->matches);
    }
}