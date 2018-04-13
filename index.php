<?php

    ini_set("session.use_only_cookies", true);
    ini_set("session.use_trans_sid", false);
    ini_set("session.cookie_lifetime", 1200); // 20mns

    session_start();

    define("ROOT", dirname(__FILE__));

    require_once "vendor/autoload.php";

    use App\Router;

    $router = new Router($_GET['url']);

    $router->get("/", "Frontend#showHome"); // Index page
    $router->post("/", "Frontend#showHome"); // Index page

    $router->get("/unset", "Frontend#unsetSession"); // Disconnect user

    $router->post("/email", "Frontend#sendMail"); // Send email

    $router->get("/articles/:id", "Frontend#detailsOfPost")->with(":id", "#[0-9]+#"); // Show the post :id
    $router->post("/articles/:id", "Frontend#addComment")->with(":id", "#[0-9]+#"); // Add a comment on the post :id

    $router->get("/articles", "Frontend#getAllPosts"); // Show all posts

    $router->get("/connexion", "Frontend#loginForm"); // Login form
    $router->post("/connexion", "Frontend#loginValidation"); // Login validation

    $router->get("/admin/articles/supprimer/:id", "Backend#deletePost")->with(":id", "#[0-9]+#"); // Delete a post

    $router->get("/admin/articles/modifier/:id", "Backend#editPost")->with(":id", "#[0-9]+#"); // Edit a post (form)
    $router->post("/admin/articles/modifier/:id", "Backend#editPost")->with(":id", "#[0-9]+#"); // Edit a post (validation)

    $router->get("/admin/articles/ajouter", "Backend#addNewPost")->with(":id", "#[0-9]+#");  // Add a new post (form)
    $router->post("/admin/articles/ajouter", "Backend#addNewPost")->with(":id", "#[0-9]+#"); // Add a new post (validation)

    $router->get("/admin/commentaires/accepter/:id", "Backend#acceptComment")->with(":id", "#[0-9]+#"); // Accept a comment

    $router->get("/admin/commentaires/supprimer/:id", "Backend#deleteComment")->with(":id", "#[0-9]+#"); // Delete a comment

    $router->get("/admin/commentaires/refuser/:id", "Backend#refuseComment")->with(":id", "#[0-9]+#"); // Refuse a comment
    $router->post("/admin/commentaires/refuser/:id", "Backend#refuseComment")->with(":id", "#[0-9]+#"); // Refuse a comment (specify reason)

    $router->get("/admin/articles", "Backend#adminPosts"); // Posts management
    $router->get("/admin/commentaires", "Backend#adminComments"); // Comments management
    $router->get("/admin", "Backend#adminHome"); // Admin main panel

    try {
        $router->run();
    } catch (Exception $e) {
        die("Error : " . $e->getMessage());
    }