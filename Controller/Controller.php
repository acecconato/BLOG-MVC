<?php

namespace Controller;

use App\Helper;
use Model\Entities\User;

abstract class Controller
{
    protected $controllerName;
    protected $token;

    /**
     * Method for generating a view and its template.
     * @param $name
     * @param array $args
     */
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
     * Method for generating only the view
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

    /**
     * Checks if the user is an administrator and also checks tokens.
     * @return bool
     */
    protected function checkIsAdmin()
    {
        if(isset($_SESSION["userObject"])) {
            /** @var User $user */
            $user = unserialize($_SESSION["userObject"]);
            if(is_object($user)) {
                if(isset($_GET["token"]) && !empty($_GET["token"])) {
                    $this->token = Helper::secureData([$_GET["token"]]);
                }

                if(isset($_POST["token"]) && !empty($_POST["token"])) {
                    $this->token = Helper::secureData([$_POST["token"]]);
                }

                if($user->getPermissionLevel() >= 10) {
                    return true;
                }
            }
        }

        header("Location: /");
        die();
    }

    /**
     * Checks if the user is connected.
     * @return bool
     */
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