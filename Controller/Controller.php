<?php

namespace Controller;

use Model\Entities\User;

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

        $templateToLoad = ROOT . "/view/layout/" . strtolower($template ) . ".php";
        $viewToLoad = ROOT . "/view/" . strtolower($view ) . "View.php";

        ob_start();
        extract($args);
        require $viewToLoad;
        $content = ob_get_clean();
        require $templateToLoad;
    }

    /**
     * @param $name
     * @param array $args
     * @throws \Exception
     */
    protected function generateViewOnly($name, $args = [])
    {
        $viewToLoad = ROOT . "/view/" . strtolower($name) . "View.php";

        if(!file_exists($viewToLoad)) {
            throw new \Exception("View doesn't exist");
        }

        extract($args);
        require $viewToLoad;
    }

    protected function checkIsAdmin()
    {
        if(isset($_SESSION["userObject"])) {
            /** @var User $user */
            $user = unserialize($_SESSION["userObject"]);
            if(is_object($user)) {
                if($user->getPermissionLevel() >= 10) {
                    return true;
                }
            }
        }

        header("Location: /");
        die();
    }

    protected function isConnected()
    {
        if(isset($_SESSION["userObject"])) {
            if(is_object(unserialize($_SESSION["userObject"]))) {
                return true;
            }
        }

        return false;
    }
}