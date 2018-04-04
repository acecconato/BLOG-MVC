<?php

namespace Controller;

use Model\Managers\CommentsManager;
use Model\Managers\Manager;
use Model\Managers\PostsManager;

class BackendController extends Controller
{

    public function __construct()
    {
        $this->controllerName = __CLASS__;
    }

    public function adminHome()
    {

        /** @var CommentsManager $commentsManager */
        /** @var PostsManager $postsManager */

        $commentsManager = Manager::getManagerOf("Comments");
        $postsManager = Manager::getManagerOf("Posts");

        $info = [];

        $info["nbTotalComments"] = $commentsManager->countTotalComments();
        $info["nbTotalAcceptedComments"] = $commentsManager->countTotalAcceptedComments();
        $info["nbTotalAcceptedComments"] = $commentsManager->countTotalRefusedComments();

        $this->generatePage("adminHome");
    }
}