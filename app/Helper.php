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
    }