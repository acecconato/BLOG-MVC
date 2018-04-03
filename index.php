<?php

session_start();

define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

require_once "vendor/autoload.php";

use App\Router;

$router = new Router($_GET['url']);

$router->get("/", "Frontend#showHome"); // Index page

$router->get("/articles/:id", "Frontend#detailsOfPost")->with(":id", "#[0-9]+#"); // Show the post :id
$router->post("/articles/:id", "Frontend#addComment")->with(":id", "#[0-9]+#"); // Add a comment on the post :id

$router->get("/articles", "Frontend#getAllPosts"); // Show all posts

$router->get("/connexion", "Frontend#loginForm"); // Login form
$router->post("/connexion", "Frontend#loginValidation"); // Login validation

$router->get("/admin/articles/supprimer/:id", "Backend#deletePost")->with(":id", "#[0-9]+#"); // Delete a post

$router->get("/admin/articles/modifier/:id", "Backend#editPost")->with(":id", "#[0-9]+#"); // Form to modify a post
$router->post("/admin/articles/modifier/:id", "Backend#addPost")->with(":id", "#[0-9]+#"); // Add a post

$router->get("/admin/articles/ajouter", "Backend#addPost")->with(":id", "#[0-9]+#");  // Form to add a post
$router->post("/admin/articles/ajouter", "Backend#addPost")->with(":id", "#[0-9]+#"); // Add a post

$router->get("/admin/articles", "Backend#adminPosts"); // Posts management
$router->get("/admin/commentaires", "Backend#adminComments"); // Comments management
$router->get("/admin", "Backend#adminHome"); // Admin main panel

try {
    $router->run();
} catch (\App\RouterException $e) {
    die("Error : " . $e->getMessage());
}