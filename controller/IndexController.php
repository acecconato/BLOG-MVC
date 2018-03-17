<?php

namespace Controller;

use Model\Post;
use Model\PostsManager;

class IndexController
{
    private static $_posts = [];

    public static function homepage()
    {
        $postsManager = new PostsManager();
        $post = $postsManager->getPostById(1);

        $post = new Post($post);
        var_dump($post);
    }
}