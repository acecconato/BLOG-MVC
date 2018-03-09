<?php

require_once "vendor/autoload.php";

use App\Router;

$router = new Router($_GET['url']);

$router->get("/posts/:id", "Posts#show");

$router->run();