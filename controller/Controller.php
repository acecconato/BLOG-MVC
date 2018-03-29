<?php

namespace Controller;

abstract class Controller
{
    protected $controllerName;

    protected function generatePage($name, $args = [])
    {
        $view = strtolower($name);

        if(!preg_match("#[\.]+#", $name)) {
            $template = $this->controllerName = trim(preg_replace("#Controller#", "", $this->controllerName), "\\");
            $template = $this->controllerName = strtolower($this->controllerName);
        } else {
            $nameExploded = explode(".", $name);

            $template = $nameExploded[0];
            $view = $nameExploded[1];
        }

        $templateToLoad = ROOT . "/view/" . strtolower($template ) . ".php";
        $viewToLoad = ROOT . "/view/" . strtolower($view ) . "View.php";

        ob_start();
        extract($args);
        require $viewToLoad;
        $content = ob_get_clean();
        require $templateToLoad;
    }
}