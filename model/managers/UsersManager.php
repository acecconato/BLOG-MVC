<?php

namespace Model\Managers;

use Model\Entities\User;

class UsersManager extends Manager
{
    public function getAllUsers()
    {
        $query = $this->dbh->prepare("
            SELECT *, DATE_FORMAT(creationDate, '%d/%m/%y à %Hh%i') as creationDate
            FROM users
            ORDER BY user_id DESC
        ");

        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    /**
     * @param $user
     * @return array
     * Search an user by this ID, Pseudo or Email address
     */
    public function getUser($user)
    {
        $query = $this->dbh->prepare("
            SELECT *, DATE_FORMAT(creationDate, '%d/%m/%y à %Hh%i') as creationDate
            FROM users
            WHERE user_id = :id 
            OR LOWER(pseudo) LIKE LOWER(:pseudo)
            OR LOWER(email) LIKE LOWER(:email)
        ");

        $query->bindValue(":id", $user, \PDO::PARAM_INT);
        $query->bindValue(":pseudo", $user, \PDO::PARAM_STR);
        $query->bindValue(":email", $user, \PDO::PARAM_STR);

        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    public function addUser(User $user)
    {
        $query = $this->dbh->prepare("
            INSERT INTO users 
            (email, pseudo, password) 
            VALUES 
            (:email, :pseudo, :password)
        ");

        $query->bindValue(":email", $user->getEmail(), \PDO::PARAM_STR);
        $query->bindValue(":pseudo", $user->getPseudo(), \PDO::PARAM_STR);
        $query->bindValue(":password", $user->getPassword(), \PDO::PARAM_STR);

        $query->execute();
        return $affectedLines = $query->rowCount();
    }

    public function updateUser(User $user)
    {
        $query = $this->dbh->prepare("
            UPDATE users
            SET permissionLevel = :permLevel, email = :email, pseudo = :pseudo, password = :password
        ");

        $query->bindValue(":permLevel", $user->getPermissionLevel(), \PDO::PARAM_INT);
        $query->bindValue(":email", $user->getEmail(), \PDO::PARAM_STR);
        $query->bindValue(":pseudo", $user->getPseudo(), \PDO::PARAM_STR);
        $query->bindValue(":password", $user->getPassword(), \PDO::PARAM_STR);

        $query->execute();
        return $affectedLines = $query->rowCount();
    }

    public function deleteUser($user)
    {
        $query = $this->dbh->prepare("
            DELETE FROM users
            WHERE user_id = :id
            OR pseudo = :pseudo
            OR email = :email
        ");

        $query->bindValue(":id", $user, \PDO::PARAM_INT);
        $query->bindValue(":pseudo", $user, \PDO::PARAM_STR);
        $query->bindValue(":email", $user, \PDO::PARAM_STR);

        $query->execute();
        return $affectedLines = $query->rowCount();
    }

}