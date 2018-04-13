<?php

    namespace App;

    abstract class PictureHelper extends Helper
    {
        /**
         * Tries to recover the requested image by performing some checks.
         * Checks if the file exists and if the file type is allowed in the yaml configuration.
         * @param $file
         * @return bool|string
         * @throws \Exception
         */
        public static function getPostPicture($file = null)
        {
            if(!is_null($file)) {
                $defaultPicturePath = Config::getInstance()->get("default_posts_picture");
                $fullPath = ROOT . $defaultPicturePath . "/" . $file;

                $pictureToLoad = implode(glob($fullPath.".*"));

                $pictureToDisplay = explode("/", $pictureToLoad);
                $pictureToDisplay = end($pictureToDisplay);

                if(file_exists($pictureToLoad)) {
                    $fileType = exif_imagetype($pictureToLoad);

                    if(PictureHelper::verifyImagePostType($fileType) == true) {
                        return $defaultPicturePath . "/" . $pictureToDisplay;
                    } else {
                        throw new \Exception("Image type is not allowed");
                    }
                }
                return null;
            }
            return null;
        }

        /**
         * Checks the type of a post image.
         * @param $fileType
         * @return bool
         */
        public static function verifyImagePostType($fileType)
        {
            $allowedTypes = Config::getInstance()->getAllowedPostsImgType();

            if(in_array($fileType, $allowedTypes)) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * Adds an image to the defined folder.
         * Also check that it does not already exist, otherwise the old one is deleted and the new one is added.
         * @param array $picture
         */
        public static function addNewPicture(array $picture)
        {
            $defaultPicturePath = Config::getInstance()->get("default_posts_picture");
            $fullPath = ROOT . $defaultPicturePath . "/" . $picture["name"];

            $pictureToLoad = implode(glob($fullPath.".*"));

            if(file_exists($pictureToLoad)) {
                unlink($pictureToLoad);
            }

            $defaultPicturePath = dirname($fullPath);
            $fileType = exif_imagetype($picture["tmp_name"]);
            $extension = image_type_to_extension($fileType);

            move_uploaded_file($picture["tmp_name"], $defaultPicturePath . "/" . $picture["name"] . $extension);
        }
    }