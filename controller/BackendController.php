<?php

namespace Controller;

use App\Helper;

use Model\Factories\CommentFactory;
use Model\factories\PostFactory;
use Model\Managers\CommentsManager;
use Model\Managers\PostsManager;

use App\CommentHelper;
use App\PostHelper;

use Model\Entities\User;

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

        $nb["comments"] = CommentHelper::countAll();
        $nb["posts"] = PostHelper::countAll();

        $this->generateAdminPage("adminHome", compact("nb"));
    }

    public function adminPosts()
    {
        $posts = PostFactory::getAllPosts();
        $this->generateAdminPage("adminListPosts", compact("posts"));
    }

    public function adminComments()
    {
        $comments = CommentFactory::getAllComments();
        $this->generateAdminPage("adminListComments", compact("comments"));
    }
}