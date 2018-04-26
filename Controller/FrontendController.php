<?php

namespace Controller;

use App\Config;
use App\EmailHelper;
use App\Helper;
use App\CommentHelper;

use App\Pagination;
use Model\Entities\Comment;
use Model\Entities\User;

use Model\Factories\PostFactory;
use Model\Factories\CommentFactory;
use Model\Factories\UserFactory;

use Model\Managers\CommentsManager;
use Model\Managers\Manager;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class FrontendController extends Controller
{
    public function __construct()
    {
        $this->controllerName = __CLASS__;
    }

    /**
     * Generates the home page
     */
    public function showHome()
    {
        if(isset($_POST["submit"])) {
            $msg = $this->sendMail();
            $this->generatePage("Home", compact("msg"));
            return;
        }

        $this->generatePage("Home");
        return;
    }

    /**
     * Generates a post's details page
     * @param $postId
     */
    public function detailsOfPost($postId)
    {
        $post = PostFactory::getPost($postId);

        if(!$post) {
            header("Location: /articles");
        }

        $comments = CommentFactory::getValidatedCommentsOfPost($post);
        $this->generatePage("Post", compact("post", "comments"));
    }

    /**
     * Performs verifications and add a comment.
     * @param $id
     */
    public function addComment($id)
    {
        $post = PostFactory::getPost($id);

        if(!$post) {
            header("Location: /articles");
        }

        $comments = CommentFactory::getValidatedCommentsOfPost($post);

        if(!isset($_POST["submit"])) {
            throw new \InvalidArgumentException("No data found");
        }

        $_POST["post_id"] = $post->getPostId();

        $commentToAdd = Helper::secureData($_POST);
        $verification = CommentHelper::verifyComment($commentToAdd);

        if($verification !== true) {
            $msg = $verification;
            $this->generatePage("Post", compact("msg", "post", "comments"));
            return;
        }

        /** @var CommentsManager $commentsManager */
        $commentsManager = Manager::getManagerOf("Comments");
        $comment = new Comment($commentToAdd);

        try {
            $commentsManager->addComment($comment);
            $msg["success"] = "Commentaire ajouté et en attente de modération";
        } catch (\Exception $e) {
            $msg["danger"] = $e->getMessage();
        }

        $this->generatePage("Post", compact("msg", "post", "comments"));
    }

    /**
     * Generates the blog page
     */
    public function getAllPosts()
    {
        $posts = PostFactory::getAllPosts();
        $pagination = new Pagination($posts, 6);

        $paginatedData = $pagination->pagine($posts);

        $posts = $paginatedData["data"];
        $navigation = $paginatedData["navigation"];

        $this->generatePage("Blog", compact("posts", "pagination", "navigation"));
    }

    /**
     * Generates the login page
     */
    public function loginForm()
    {
        if($this->isConnected()) {
            header("Location: /admin");
        }

        try {
            $this->generateViewOnly("Login");
        } catch (\Exception $e) {
            echo "Error : " . $e->getMessage();
            return;
        }
    }

    /**
     * Disconnects the user by destroying his sessions.
     */
    public function unsetSession()
    {
        unset($_SESSION["token"]);
        unset($_SESSION["userObject"]);
        session_destroy();

        header("Location: /");
    }

    /**
     * Check the login form and connect the user by creating $_SESSION if everything is good.
     * Otherwrise, redirect to the login page.
     */
    public function loginValidation()
    {
        if (!isset($_POST["submit"])) {
            throw new \InvalidArgumentException("No form data found");
        }

        $formData = $_POST;

        $verifiedFormData = Helper::secureData($formData);
        $verification = Helper::verifyLoginForm($verifiedFormData);

        if($verification === true) {
            $identifier = $verifiedFormData["identifier"];
            $password = $verifiedFormData["password"];
            /** @var User $user */
            $user = UserFactory::tryConnectUser($identifier, $password);

            if(!is_object($user)) {
                $msg = $user;
            } else {
                try {
                    session_regenerate_id(true);
                    $_SESSION["userObject"] = serialize($user);
                    $_SESSION["token"] = bin2hex(random_bytes(16));
                } catch (\Exception $e) {
                    echo "Impossible de se connecter : " . $e->getMessage();
                    session_destroy();
                }

                header("Location: /connexion");
            }

        } else {
            $msg = $verification;
        }

        try {
            $this->generateViewOnly("Login", compact("msg"));
        } catch (\Exception $e) {
            die("Error : " . $e->getMessage());
        }
    }

    /**
     * Checks the data in the email form and sends the email to the recipient.
     * @return array|bool
     */
    public function sendMail()
    {
        $formData = Helper::secureData($_POST);
        $errors = EmailHelper::formValidation($formData);

        if($errors != false){
            return $errors;
        }

        extract($formData);

        $mail = new PHPMailer(true);

        /** @var string $name */
        /** @var string $email */
        /** @var string $message */

        try {

            $name = strip_tags($name);
            $email = strip_tags($email);
            $message = strip_tags($message);

            $mail->setLanguage("fr");
            $mail->CharSet =  "utf-8";

            $mail->setFrom($email, $name);
            $mail->AddAddress(Config::getInstance()->get("contact_email"));

            $mail->Subject  =  'Personnal Blog : Nouveau message !';
            $mail->IsHTML(true);

            $bodyMessage = '<p><strong>Nom : </strong>' . $name . '
                            <br />
                            <strong>Email : </strong> ' . $email . '
                            <br />';

            (isset($phone) && !empty($phone)) ? $bodyMessage .= "<strong>Téléphone : </strong> " . strip_tags($phone) : null;

            $bodyMessage .= "</p><p>" . $message . "</p>";

            $mail->Body = trim(stripslashes($bodyMessage));
            $mail->AltBody = trim(strip_tags($mail->Body));

            $msg = [];
            if($mail->Send()) {
                $msg["success"] = "Le message a bien été envoyé !";
            } else {
                $msg["warning"] =  "Erreur ->" . $mail->ErrorInfo;
            }

        } catch (Exception $e) {
            $msg["danger"] = "Impossible d'envoyer l'email";
        }

        return $msg;
    }
}