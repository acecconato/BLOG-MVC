<?php

namespace Controller;

use App\CommentHelper;
use App\Helper;
use Model\Entities\Comment;
use Model\Entities\User;
use Model\Factories\PostFactory;
use Model\Factories\CommentFactory;
use Model\Factories\UserFactory;
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
        $verification = CommentHelper::verifyComment($commentToAdd);

        if($verification === true) {
            /** @var CommentsManager $commentsManager */
            $commentsManager = Manager::getManagerOf("Comments");
            $comment = new Comment($commentToAdd);

            try {
                $commentsManager->addComment($comment);
                $msg["success"] = "Commentaire ajouté et en attente de modération";
            } catch (\Exception $e) {
                $msg["danger"] = $e->getMessage();
            }

        } else {
            $msg = $verification;
        }

        $this->generatePage("Post", compact("msg", "post", "comments"));
    }

    public function getAllPosts()
    {
        $posts = PostFactory::getAllPosts();
        $this->generatePage("Blog", compact("posts"));
    }

    public function loginForm()
    {
        if($this->isConnected()) {
            header("Location: /admin");
        }
            try {
                $this->generateViewOnly("Login");
            } catch (\Exception $e) {
                die("Error : " . $e->getMessage());
            }
    }

    public function unsetSession()
    {
        unset($_SESSION["userObject"]);
        session_destroy();

        header("Location: /connexion");
    }

    public function loginValidation()
    {
        if (!isset($_POST["submit"])) {
            throw new \InvalidArgumentException("No form data found");
        }

        $formData = $_POST;

        $verifiedFormData = Helper::secureData($formData);
        $verification = Helper::verifyLoginForm($verifiedFormData);

        if($verification === true) {
            $identifier = $verifiedFormData["identifier"];
            $password = $verifiedFormData["password"];
            /** @var User $user */
            $user = UserFactory::tryConnectUser($identifier, $password);

            if(!is_object($user)) {
                $msg = $user;
            } else {
                $_SESSION["userObject"] = serialize($user);
                header("Location: /connexion");
            }

        } else {
            $msg = $verification;
        }

        try {
            $this->generateViewOnly("Login", compact("msg"));
        } catch (\Exception $e) {
            die("Error : " . $e->getMessage());
        }
    }
}