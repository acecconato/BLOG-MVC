<?php

namespace Controller;

use App\Config;
use Model\Post;
use Model\PostsManager;

class IndexController
{
    private static $_posts = [];

    public static function homepage()
    {
        $postsManager = new PostsManager();
        $posts = $postsManager->getAllPosts();

        foreach ($posts as $k => $v) {
            self::$_posts[$k] = new Post($v);
        }

        // PAGINATION !

    }
}