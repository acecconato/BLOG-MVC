<?php

    namespace App;

    abstract class Picture
    {
        /**
         * @param $file
         * @return bool|string
         * @throws \Exception
         */
        public static function getPostPicture($file)
        {
            $defaultPicturePath = Config::getInstance()->get("default_posts_picture");
            $fullPath = ROOT . $defaultPicturePath . "/" . $file;

            $pictureToLoad = implode(glob($fullPath.".*"));

            $pictureToDisplay = explode("/", $pictureToLoad);
            $pictureToDisplay = end($pictureToDisplay);

            if(file_exists($pictureToLoad)) {
                $fileType = exif_imagetype($pictureToLoad);
                $allowedTypes = Config::getInstance()->getAllowedPostsImgType();

                if(in_array($fileType, $allowedTypes)) {
                    return $defaultPicturePath . "/" . $pictureToDisplay;
                } else {
                    throw new \Exception("Image type is not allowed");
                }
            }
            return false;
        }

        public static function addNewPicture($picture)
        {

        }
    }