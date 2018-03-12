<?php

require_once "vendor/autoload.php";

use App\Router;

$router = new Router($_GET['url']);

$router->get("/", "Posts#showAll");
$router->get("/posts/:id", "Posts#show")->with(":id", "#[0-9]+#");

$router->run();