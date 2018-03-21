<?php

namespace Controller;

use Model\CommentsManager;
use Model\Post;
use Model\PostsManager;

class IndexController
{
    public static function homepage()
    {
        $commentsManager = new CommentsManager();
        $comments = $commentsManager->getAllComments();

        print_r($comments);
    }
}