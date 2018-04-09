<?php

    namespace Model\factories;

    use Model\Managers\Manager;

    abstract class Factory
    {
        private static $managers = [];

        public static function getManager($manager)
        {
            self::$managers["posts"] = Manager::getManagerOf("Posts");
            self::$managers["comments"] = Manager::getManagerOf("Comments");
            self::$managers["users"] = Manager::getManagerOf("Users");

            if(!is_object(self::$managers[$manager])) {
                throw new \InvalidArgumentException("Object not found");
            }

            return self::$managers[$manager];
        }
    }