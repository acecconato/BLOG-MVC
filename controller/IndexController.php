<?php

namespace Controller;

use Model\Post;
use Model\PostsManager;

class IndexController
{
    private static $_posts = [];

    public function homepage()
    {
        $postsManager = new PostsManager();
        $posts = $postsManager->getAllPosts();

        foreach ($posts as $k => $v) {
            self::$_posts[$k] = new Post($v);
        }

        foreach(self::$_posts as $k => $v) {
            print_r($v);
        }

    }
}