<?php

namespace Controller;

use Model\Entities\Comment;
use Model\Entities\Post;
use Model\Managers\CommentsManager;
use Model\Managers\Manager;
use Model\Managers\PostsManager;

class FrontendController extends Controller
{
    private $comments = [];
    private $posts = [];

    public function __construct()
    {
        $this->controllerName = __CLASS__;
    }

    public function showHome()
    {
        $this->generatePage("home");
    }

    public function detailsOfPost($id)
    {
        /** @var \Model\Managers\PostsManager $postsManager */
        /** @var \Model\Managers\CommentsManager $commentsManager */

        $postsManager = Manager::getManagerOf("Posts");
        $commentsManager = Manager::getManagerOf("Comments");

        $postData = $postsManager->getPostById($id);

        if(!is_array($postData)) {
            header("Location: /articles");
        }

        $post = new Post($postData);
        $validatedComments = $commentsManager->getValidatedCommentsOfPost($post);

        foreach ($validatedComments as $key => $data) {
            $this->comments[] = new Comment($data);
        }

        $comments = $this->comments;
        $this->generatePage("Post", compact("post", "comments"));
    }

    public function addComment($id)
    {
        /** @var \Model\Managers\PostsManager $postsManager */
        /** @var \Model\Managers\CommentsManager $commentsManager */

        $postsManager = Manager::getManagerOf("Posts");
        $commentsManager = Manager::getManagerOf("Comments");

        $postData = $postsManager->getPostById($id);

        if(!is_array($postData)) {
            header("Location: /articles");
        }

        $post = new Post($postData);
        $validatedComments = $commentsManager->getValidatedCommentsOfPost($post);

        foreach ($validatedComments as $key => $data) {
            $this->comments[] = new Comment($data);
        }

        $comments = $this->comments;

        if(!isset($_POST["submit"])) {
            throw new \InvalidArgumentException("No data found");
        }

        $pseudo = strip_tags(trim($_POST["pseudo"]));
        $message = strip_tags(trim($_POST["message"]));

        if(!isset($pseudo) || empty($pseudo) || !isset($message) || empty($message)) {
            $msg["warning"] = "Vous devez remplir tous les champs";
        }

        if(strlen($pseudo) > 50) {
            $msg["warning"] = "Le pseudo ne doit pas dépasser 50 caractères";
        }

        if(!isset($msg["error"]) && !isset($msg["warning"])) {
            $comment = new Comment(["content" => $message, "author" => $pseudo, "post_id" => $id]);
            $result = $commentsManager->addComment($comment);
        }

        if ($result > 0) {
            $msg["success"] = "Le commentaire a bien été ajouté ! Il est désormais en attende de modération";
        } else {
            $msg["error"] = "Impossible d'ajouter le commentaire";
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

    }

    public function loginValidation()
    {

    }
}