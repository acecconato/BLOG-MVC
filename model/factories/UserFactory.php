<?php

    namespace Model\Factories;

    use Model\Entities\User;
    use Model\Managers\Manager;
    use Model\Managers\UsersManager;

    abstract class UserFactory
    {
        public static function tryConnectUser($identifier, $password)
        {
            /** @var UsersManager $usersManager */
            $usersManager = Manager::getManagerOf("Users");
            $userToCreate = $usersManager->loginVerification($identifier, $password);

            if(!is_array($userToCreate) || $userToCreate === false) {
                $err["danger"] = "L'identifiant et/ou le mot de passe est incorrect";
                return $err;
            }

            $userToCreate = $usersManager->getUser($userToCreate["pseudo"]);
            return new User($userToCreate);
        }
    }