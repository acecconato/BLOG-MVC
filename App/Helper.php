<?php

    namespace App;

    abstract class Helper
    {
        /**
         * Receives a data table to secure its values and return them.
         * Deletes tags directly, this method is not adapted in order to format HTML in the future.
         * @param array $data
         * @return array
         */
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

        /**
         * Checks the data sent by the user when trying to connect.
         * @param $loginForm
         * @return bool
         */
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

        /**
         * Checks the data sent by the user when trying to add a post.
         * This function returns several callbacks in order to use them in the call method.
         * @param $data
         * @param callable $callback
         * @return mixed
         */
        public static function verifyAddPostForm($data, callable $callback)
        {
            $title = $data["title"];
            $image = $_FILES["image"];
            $content = $data["content"];

            if(!isset($title) || !isset($image) || !isset($content) || empty($title) || empty($content)) {
                $err["warning"] = "Vous devez renseigner les champs requis";
                $callback(false, $err);
            }

            if(strlen($title) > 100) {
                $err["warning"] = "La longueur du titre est supérieure à 100 caractères";
            }

            // File error verification
            if($image["error"] > 0 && $image["error"] != UPLOAD_ERR_NO_FILE) {
                switch ($image["error"]) {
                    case UPLOAD_ERR_INI_SIZE || UPLOAD_ERR_FORM_SIZE:
                        $err["danger"] = "Le fichier est trop volumineux (1Mb maximum)";
                        break;
                    case UPLOAD_ERR_PARTIAL:
                        $err["danger"] = "Le fichier n'a été que partiellement téléchargé";
                        break;
                    case UPLOAD_ERR_NO_TMP_DIR:
                        $err["danger"] = "Un dossier temporaire est manquant. Merci de contacter l'administrateur";
                        break;
                    case UPLOAD_ERR_CANT_WRITE:
                        $err["danger"] = "Échec de l'écriture du fichier sur le disque. Merci de contacter l'administrateur";
                        break;
                    default:
                        $err["danger"] = "Erreur lors du transfert de l'image";
                }
            }

            if($image["size"] > 0) {
                if($image["size"] > 1048576) {
                    $err["danger"] = "Fichier trop volumineux (1Mb max)";
                }

                $fileType = exif_imagetype($image["tmp_name"]);

                if(PictureHelper::verifyImagePostType($fileType)) {
                    return $callback(true, null, $image);
                } else {
                    $err["danger"] = "Fichier non authorisé";
                }
            }

            if(isset($err) && !empty($err)) {
                return $callback(false, $err);
            }

            return $callback(true);
        }

        /**
         * Checks a user's tokens to protect him against Cross Site Request Forgery
         * @param $token
         * @return bool
         */
        public static function verifyToken($token)
        {
            if(!isset($_SESSION["token"]) || empty($_SESSION["token"])) {
                return false;
            }

            if($_SESSION["token"] != $token[0]) {
                return false;
            }

            return true;
        }
    }