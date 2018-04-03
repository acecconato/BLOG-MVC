<?php
    namespace App;

    class Helper
    {
        public static function secureData(array $data)
        {
            $vars = [];
            foreach ($data as $k => $v) {
                $vars[$k] = trim(strip_tags($v));
            }

            return $vars;
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

            if(!empty($err)) {
                return $err;
            }

            return true;
        }
    }