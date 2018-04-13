<?php

    namespace Model\Factories;

    use Model\Entities\User;

    abstract class UserFactory extends Factory
    {
        /**
         * Trying to connect the user by checking his information.
         * If it's good, returns the user's object.
         * @param $identifier
         * @param $password
         * @return User
         */
        public static function tryConnectUser($identifier, $password)
        {
            $userToCreate = self::getManager("users")->loginVerification($identifier, $password);

            if(!is_array($userToCreate) || $userToCreate === false) {
                $err["danger"] = "L'identifiant et/ou le mot de passe est incorrect";
                return $err;
            }

            $userToCreate = self::getManager("users")->getUser($userToCreate["pseudo"]);
            return new User($userToCreate);
        }
    }