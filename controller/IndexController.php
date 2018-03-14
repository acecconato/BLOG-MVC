<?php

namespace Controller;

use Model\PostsManager;

class IndexController
{
    public function homepage()
    {
        $postsManager = new PostsManager();
        $postsManager->getAllPosts();
    }
}