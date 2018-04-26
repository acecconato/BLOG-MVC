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

    /**
     * Generates the admin home page
     */
    public function adminHome()
    {
        /** @var CommentsManager $commentsManager */
        /** @var PostsManager $postsManager */

        $count["comments"] = CommentHelper::countAll();
        $count["posts"] = PostHelper::countAll();

        $this->generatePage("adminHome", compact("count"));
    }

    /**
     * Generates the posts administration page
     */
    public function adminPosts()
    {
        $posts = PostFactory::getAllPosts();
        $pagination = new Pagination($posts, 10);

        $paginatedData = $pagination->pagine($posts);

        $posts = $paginatedData["data"];
        $navigation = $paginatedData["navigation"];

        $this->generatePage("adminListPosts", compact("posts", "pagination", "navigation"));
    }

    /**
     * Generates the comments administration page
     */
    public function adminComments()
    {
        $comments = CommentFactory::getAllComments();

        $pagination = new Pagination($comments, 10);

        $paginatedData = $pagination->pagine($comments);

        $comments = $paginatedData["data"];
        $navigation = $paginatedData["navigation"];

        $this->generatePage("adminListComments", compact("comments", "pagination", "navigation"));
    }

    /**
     * Method for accepting a comment.
     * @param $commentId
     * @return bool
     */
    public function acceptComment($commentId)
    {
        if(Helper::verifyToken($this->token) == false) {
            echo "Token invalide";
            return false;
        }

        $comment = CommentFactory::getComment($commentId);
        $comment->setStatus_id(2);

        CommentFactory::updateComment($comment);
        return header("Location: /admin/commentaires");
    }


     // Method for refuse a comment.

    public function refuseComment($commentId)
    {
        if(Helper::verifyToken($this->token) == false) {
            echo "Token invalide";
            return false;
        }

        $comment = CommentFactory::getComment($commentId);

        if( (int) $comment->getStatus_id() !== 1) {
            return header("Location: /admin/commentaires");
        }

        if(!isset($_POST["reason"])) {
            $this->generatePage("reasonInput");
            return false;
        }

        $securedData = (empty($_POST["reason"])) ? Helper::secureData(["reason" => "Non spécifié"]) : Helper::secureData($_POST);

        $comment->setStatus_id(3);
        $comment->setReason($securedData["reason"]);

        CommentFactory::updateComment($comment);
        return header("Location: /admin/commentaires");
    }

    /**
     * Method for delete a comment.
     * @param $commentId
     * @return bool
     */
    public function deleteComment($commentId)
    {
        if(Helper::verifyToken($this->token) == false) {
            echo "Token invalide";
            return false;
        }

        $comment = CommentFactory::getComment($commentId);
        CommentFactory::deleteComment($comment);

        return header("Location: /admin/commentaires");
    }

    /**
     * Method for delete a post
     * @param $postId
     * @return bool
     */
    public function deletePost($postId)
    {
        if(Helper::verifyToken($this->token) == false) {
            echo "Token invalide";
            return false;
        }

        $post = PostFactory::getPost($postId);
        PostFactory::deletePost($post);

        return header("Location: /admin/articles");
    }

    /**
     * Method for adding a new post
     * @return bool
     */
    public function addNewPost()
    {
        if(isset($_POST["submit"])) {

            if(Helper::verifyToken($this->token) == false) {
                echo "Token invalide";
                return false;
            }

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

    /**
     * Method for edit a post
     * @param $postId
     * @return bool
     */
    public function editPost($postId)
    {
        if(Helper::verifyToken($this->token) == false) {
            echo "Token invalide";
            return false;
        }

        /** @var \Model\Entities\Post $post */
        $post = PostFactory::getPost($postId);

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