<?php

namespace Controller;

use Model\Post;
use Model\PostsManager;
use Model\UsersManager;

class IndexController
{
    private static $_posts = [];

    public static function homepage()
    {


        $manager = new UsersManager();
        $users = $manager->getAllUsers();

        print_r($users);
        // PAGINATION !

    }
}