<?php

    namespace App;

    abstract class PictureHelper extends Helper
    {
        /**
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

        public static function verifyImagePostType($fileType)
        {
            $allowedTypes = Config::getInstance()->getAllowedPostsImgType();

            if(in_array($fileType, $allowedTypes)) {
                return true;
            } else {
                return false;
            }
        }

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