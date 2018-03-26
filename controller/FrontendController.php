<?php

namespace Controller;

use Model\Entities\Post;
use Model\Managers\Manager;
use Model\Managers\PostsManager;

class FrontendController
{
    private $posts = [],
            $comments = [];

    public static function showHome()
    {
        include dirname(__DIR__) . '/view/homeView.php';
    }

    public function getPost($id)
    {
            if((int) $id > 0) {
            /** @var PostsManager $postsManager */
            $postsManager = Manager::getManagerOf("Posts");
            $post = new Post($postsManager->getPostById($id));

            include dirname(__DIR__) . "/view/postView.php";
        }
    }

    public function addComment()
    {

    }

    public function getAllPosts()
    {

    }

    public function loginForm()
    {

    }

    public function loginValidation()
    {

    }
}