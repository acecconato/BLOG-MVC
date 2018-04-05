<?php

    namespace App;

    abstract class Helper
    {
        public static function secureData(array $data)
        {
            $vars = [];
            foreach ($data as $key => $value) {

                $value = trim($value);
                $value = strip_tags($value);
                $value = addslashes($value);

                $vars[$key] = $value;
            }

            return $vars;
        }

        public function displayFormattedContentFromDb($content)
        {
            $content = stripslashes($content);
            $content = nl2br($content);

            return $content;
        }

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

        public static function verifyLoginForm($loginForm)
        {
            $identifier = $loginForm["identifier"];
            $password = $loginForm["password"];

            if (!isset($identifier) || !isset($password) || empty($identifier) || empty($password)) {
                $err["warning"] = "Vous devez remplir tous les champs";
            }

            if(isset($err) && !empty($err)) {
                return $err;
            }

            return true;
        }

        public static function sessionExist()
        {
            if(isset($_SESSION["userObject"])) {
                return true;
            }

            return false;
        }
    }