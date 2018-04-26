<?php

    namespace App;

    use Model\Managers\Manager;
    use Model\Managers\CommentsManager;

    abstract class CommentHelper extends Helper
    {
        /**
         * Count all comments and order the result by their status
         * This method is called when displaying the admin homepage
         * @return mixed
         */
        public static function countAll()
        {
            /** @var CommentsManager $commentsManager */
            $commentsManager = Manager::getManagerOf("Comments");
            $countComments = $commentsManager->countComments();

            $count["all"] = 0;
            $count["accepted"] = 0;
            $count["refused"] = 0;
            $count["awaitingModeration"] = 0;

            foreach ($countComments as $result) {
                switch ($result["status_id"]) {
                    case 1:
                        $count["all"]++;
                        $count["awaitingModeration"]++;
                        break;
                    case 2:
                        $count["all"]++;
                        $count["accepted"]++;
                        break;
                    case 3:
                        $count["all"]++;
                        $count["refused"]++;
                        break;
                }
            }

            return $count;
        }

        /**
         * Checks the data sent by the user when trying to add a new comment.
         * @param $commentData
         * @return array|bool
         */
        public static function verifyComment($commentData)
        {
            $pseudo = $commentData["author"];
            $message = $commentData["content"];

            $err = [];

            if(!isset($pseudo) || empty($pseudo) || !isset($message) || empty($message)) {
                $err["warning"] = "Tous les champs ne sont pas remplis";
            }

            if(strlen($pseudo) > 50) {
                $err["warning"] = "Le pseudo ne doit pas dépasser 50 caractères";
            }

            if(isset($err) && !empty($err)) {
                return $err;
            }

            return true;
        }
    }