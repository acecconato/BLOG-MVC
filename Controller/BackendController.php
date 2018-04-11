<?php

namespace Controller;

use App\Helper;
use App\Pagination;
use App\PictureHelper;
use App\CommentHelper;
use App\PostHelper;

use Model\Factories\CommentFactory;
use Model\Factories\PostFactory;

use Model\Managers\CommentsManager;
use Model\Managers\PostsManager;


class BackendController extends Controller
{

    public function __construct()
    {
        $this->checkIsAdmin();
        $this->controllerName = __CLASS__;
    }

    public function adminHome()
    {
        /** @var CommentsManager $commentsManager */
        /** @var PostsManager $postsManager */

        $nb["comments"] = CommentHelper::countAll();
        $nb["posts"] = PostHelper::countAll();

        $this->generatePage("adminHome", compact("nb"));
    }

    public function adminPosts()
    {
        $posts = PostFactory::getAllPosts();
        $pagination = new Pagination($posts, 10);

        $paginatedData = $pagination->pagine($posts);

        $posts = $paginatedData["data"];
        $navigation = $paginatedData["navigation"];

        $this->generatePage("adminListPosts", compact("posts", "pagination", "navigation"));
    }

    public function adminComments()
    {
        $comments = CommentFactory::getAllComments();

        $pagination = new Pagination($comments, 10);

        $paginatedData = $pagination->pagine($comments);

        $comments = $paginatedData["data"];
        $navigation = $paginatedData["navigation"];

        $this->generatePage("adminListComments", compact("comments", "pagination", "navigation"));
    }

    public function acceptComment($id)
    {
        $comment = CommentFactory::getComment($id);
        $comment->setStatus_id(2);

        CommentFactory::updateComment($comment);
        return header("Location: /admin/commentaires");
    }

    public function refuseComment($id)
    {
        $comment = CommentFactory::getComment($id);

        if($comment->getStatus_id() == 1) {
            if(!isset($_POST["reason"])) {
                $this->generatePage("reasonInput");
            } else {

                if(empty($_POST["reason"])) {
                    $securedData = Helper::secureData(["reason" => "Non spécifié"]);
                } else {
                    $securedData = Helper::secureData($_POST);
                }

                $comment->setStatus_id(3);
                $comment->setReason($securedData["reason"]);

                CommentFactory::updateComment($comment);
                return header("Location: /admin/commentaires");
            }
        } else {
            return header("Location: /admin/commentaires");
        }
        return false;
    }

    public function deleteComment($id)
    {
        $comment = CommentFactory::getComment($id);
        CommentFactory::deleteComment($comment);

        return header("Location: /admin/commentaires");
    }

    public function deletePost($id)
    {
        $post = PostFactory::getPost($id);
        PostFactory::deletePost($post);

        return header("Location: /admin/articles");
    }

    public function addNewPost()
    {
        if(isset($_POST["submit"])) {

            $postData = Helper::secureData($_POST);

            Helper::verifyAddPostForm($postData, function($formIsValid, $msg = null, $image = null)
            use ($postData)
            {
                if( (bool) $formIsValid === true) {

                    $post = PostFactory::createPost($postData);
                    $lastInsertId = PostFactory::addNewPost($post);

                    if(!is_null($image)) {
                        $image["name"] = $lastInsertId;
                        PictureHelper::addNewPicture($image);

                        $post = PostFactory::getPost($lastInsertId);
                        $post->setPicture($lastInsertId);

                        PostFactory::updatePost($post, false);
                    }

                    $msg["success"] = "L'article a bien été ajouté ! (<a class='text-white' href='/articles/" . $lastInsertId . "' target='_blank'>voir</a>)";
                }

                $this->generatePage("adminAddPost", compact("msg"));
            });

        } else {
            $this->generatePage("adminAddPost");
        }
    }

    public function editPost($id)
    {
        /** @var \Model\Entities\Post $post */
        $post = PostFactory::getPost($id);

        if(isset($_POST["submit"])) {

           $postData = Helper::secureData($_POST);

            Helper::verifyAddPostForm($postData, function($formIsValid, $msg = null, $image = null)
            use ($postData, $post)
            {
                if( (bool) $formIsValid === true) {

                    $post->setTitle($postData["title"]);
                    $post->setContent($postData["content"]);

                    if(!is_null($image)) {
                        $image["name"] = $post->getPostId();
                        PictureHelper::addNewPicture($image);

                        $post->setPicture($post->getPostId());
                    }

                    PostFactory::updatePost($post);
                    $msg["success"] = "L'article a bien été modifié ! (<a class='text-white' href='/articles/" . $post->getPostId() . "' target='_blank'>voir</a>)";
                }

                $this->generatePage("adminEditPost", compact("post", "msg"));
            });

        } else {
            $this->generatePage("adminEditPost", compact("post"));
        }
    }
}