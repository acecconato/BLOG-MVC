<?php

namespace Model\Managers;

class UsersManager extends Manager
{
    /**
     * Verify if the user's identifier matches the password.
     * If it's good, returns the user as an array.
     * @param $identifier
     * @param $pass
     * @return bool|mixed
     */
    public function loginVerification($identifier, $pass)
    {
        $query = $this->dbh->prepare("
            SELECT pseudo, email, password
            FROM users
            WHERE pseudo = :identifier OR email = :identifier
        ");

        $query->bindValue(":identifier", $identifier, \PDO::PARAM_STR);

        $query->execute();
        $user = $query->fetch();

        if(!password_verify($pass, $user["password"])) {
            return false;
        }

        return $user;
    }

    /**
     * Returns the requested user as an array.
     * @param $user
     * @return mixed
     */
    public function getUser($user)
    {
        $query = $this->dbh->prepare("
            SELECT *, DATE_FORMAT(creationDate, '%d/%m/%y à %Hh%i') as creationDate
            FROM users
            WHERE user_id = :id 
            OR pseudo LIKE :pseudo
            OR email LIKE :email
        ");

        $query->bindValue(":id", $user, \PDO::PARAM_INT);
        $query->bindValue(":pseudo", $user, \PDO::PARAM_STR);
        $query->bindValue(":email", $user, \PDO::PARAM_STR);

        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        return $result;
    }
}