<?php

require_once "vendor/autoload.php";

use App\Router;

$router = new Router($_GET['url']);

$router->get("/", "Frontend#showHome"); // Index page

$router->get("/articles/:id", "Frontend#getPost")->with(":id", "#[0-9]+#"); // Show the post :id
$router->post("/articles/:id/", "Backend#addComment")->with(":id", "#[0-9]+#"); // Add a comment on the post :id

$router->get("/articles", "Frontend#getAllPosts"); // Show all posts

$router->get("/connexion", "Frontend#loginInput"); // Login form
$router->post("/connexion", "Backend#loginValidation"); // Login validation

$router->get("/inscription", "Frontend#registerInput"); // Register form
$router->post("/inscription", "Backend#registerValidation"); // Register validation

$router->get("/admin/articles/supprimer/:id", "Backend#addPost")->with(":id", "#[0-9]+#"); // Delete a post

$router->get("/admin/articles/modifier/:id", "Backend#addPost")->with(":id", "#[0-9]+#"); // Form to modify a post
$router->post("/admin/articles/modifier/:id", "Backend#addPost")->with(":id", "#[0-9]+#"); // Modify a post

$router->get("/admin/articles/ajouter", "Backend#addPost")->with(":id", "#[0-9]+#");  // Form to add a post
$router->post("/admin/articles/ajouter", "Backend#addPost")->with(":id", "#[0-9]+#"); // Add a post

$router->get("/admin/articles", "Backend#postsManagement"); // Posts management
$router->get("/admin", "Backend#showAdminHome"); // Admin main panel

try {
    $router->run();
} catch (\App\RouterException $e) {
    die("Error : " . $e->getMessage());
}