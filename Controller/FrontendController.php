<?php

namespace Controller;

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

    public function detailsOfPost($id)
    {
        $post = PostFactory::getPost($id);

        if(!$post) {
            header("Location: /articles");
        }

        $comments = CommentFactory::getValidatedCommentsOfPost($post);
        $this->generatePage("Post", compact("post", "comments"));
    }

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

        if($verification === true) {
            /** @var CommentsManager $commentsManager */
            $commentsManager = Manager::getManagerOf("Comments");
            $comment = new Comment($commentToAdd);

            try {
                $commentsManager->addComment($comment);
                $msg["success"] = "Commentaire ajouté et en attente de modération";
            } catch (\Exception $e) {
                $msg["danger"] = $e->getMessage();
            }

        } else {
            $msg = $verification;
        }

        $this->generatePage("Post", compact("msg", "post", "comments"));
    }

    public function getAllPosts()
    {
        $posts = PostFactory::getAllPosts();
        $pagination = new Pagination($posts, 6);

        $paginatedData = $pagination->pagine($posts);

        $posts = $paginatedData["data"];
        $navigation = $paginatedData["navigation"];

        $this->generatePage("Blog", compact("posts", "pagination", "navigation"));
    }

    public function loginForm()
    {
        if($this->isConnected()) {
            header("Location: /admin");
        }
            try {
                $this->generateViewOnly("Login");
            } catch (\Exception $e) {
                die("Error : " . $e->getMessage());
            }
    }

    public function unsetSession()
    {
        unset($_SESSION["userObject"]);
        session_destroy();

        header("Location: /connexion");
    }

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
                $_SESSION["userObject"] = serialize($user);
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
            $mail->setLanguage("fr");
            $mail->CharSet =  "utf-8";

            $mail->setFrom($email, $name);
            $mail->AddAddress('antho.cecc@gmail.com');

            $mail->Subject  =  'Personnal Blog : Nouveau message !';
            $mail->IsHTML(true);
            $mail->Body    =    '<p><strong>Nom : </strong>' . $name . '
                                <br />
                                <strong>Email : </strong> ' . $email . '
                                <br /> ';

            (isset($phone) && !empty($phone)) ? $mail->Body .= "<strong>Téléphone : </strong> " . $phone : null;

            $mail->Body .= "</p><p>" . $message . "</p>";

            $mail->AltBody = strip_tags($mail->Body);

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