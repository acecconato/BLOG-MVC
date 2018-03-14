<?php

require_once "vendor/autoload.php";

use App\Router;

$router = new Router($_GET['url']);

$router->get("/", "Index#homepage");
$router->get("/articles", "Post#showAll");
$router->get("/article/:id", "Post#show")->with(":id", "#[0-9]+#");

try {
    $router->run();
} catch (\App\RouterException $e) {
    die("Error : " . $e->getMessage());
}