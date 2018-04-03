<?php

namespace Controller;

use App\Helper;
use Model\Entities\Post;
use Model\Factories\PostFactory;
use Model\Factories\CommentFactory;
use Model\Managers\CommentsManager;
use Model\Managers\Manager;


class FrontendController extends Controller
{
    public function __construct()
    {
        $this->controllerName = __CLASS__;
    }

    public function showHome()
    {
        $this->generatePage("Home");
    }

    public function detailsOfPost($id)
    {
        $post = PostFactory::getPostById($id);

        if(!$post) {
            header("Location: /articles");
        }

        $comments = CommentFactory::getValidatedCommentsOfPost($post);
        $this->generatePage("Post", compact("post", "comments"));
    }

    public function addComment($id)
    {
        $post = PostFactory::getPostById($id);

        if(!$post) {
            header("Location: /articles");
        }

        $comments = CommentFactory::getValidatedCommentsOfPost($post);

        if(!isset($_POST["submit"])) {
            throw new \InvalidArgumentException("No data found");
        }

        $_POST["post_id"] = $post->getPostId();

        $commentToAdd = Helper::secureData($_POST);
        $verification = Helper::verifyComment($commentToAdd);

        if($verification === true) {
             $affectedLines = CommentFactory::addComment($commentToAdd);
             if($affectedLines < 1) {
                 $msg["danger"] = "Une erreur est survenu";
             }
             $msg["success"] = "Commentaire ajouté et en attente de modération";
        } else {
            $msg = $verification;
        }

        $this->generatePage("Post", compact("msg", "post", "comments"));
    }

    public function getAllPosts()
    {
        /** @var PostsManager $postsManager */
        $postsManager = Manager::getManagerOf("Posts");
        $posts = $postsManager->getAllPosts();

        foreach ($posts as $post) {
            $this->posts[] = new Post($post);
        }

        $posts = $this->posts;
        $this->generatePage("Blog", compact("posts"));
    }

    public function loginForm()
    {
        try {
            $this->generateBlankPage("Login");
        } catch (\Exception $e) {
            die("Error : " . $e->getMessage());
        }
    }

    public function loginValidation()
    {
        if (!isset($_POST["submit"])) {
            throw new \InvalidArgumentException("No data found");
        }

        $identifier = $_POST["identifier"];
        $password = $_POST["password"];

        if (!isset($identifier) || !isset($password) || empty($identifier) || empty($password)) {
            $msg["warning"] = "Vous devez remplir tous les champs";
        }

        /** @var UsersManager $usersManager */
        $usersManager = Manager::getManagerOf("Users");
        $result = $usersManager->connectionQuery($identifier, $password);

        if (!is_array($result)) {
            $msg["danger"] = "L'identifiant et/ou le mot de passe ne correspondent pas";
        } else {
            $userData = $usersManager->getUser($result["pseudo"]);
            $user = new User($userData);
            $_SESSION["connected"] = true;
            $_SESSION["user"] = serialize($user);
        }

        try {
            $this->generateBlankPage("Login", compact("msg"));
        } catch (\Exception $e) {
            die("Error : " . $e->getMessage());
        }
    }
}