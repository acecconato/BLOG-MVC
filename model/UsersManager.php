<?php

namespace Model;

class UsersManager extends PDOFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers()
    {
        $query = parent::$_dbh->prepare("
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
        $query = parent::$_dbh->prepare("
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
        $query = parent::$_dbh->prepare("
            INSERT INTO users 
            (email, pseudo, password) 
            VALUES 
            (:email, :pseudo, :password)
        ");

        $query->bindValue(":email", $user->getEmail(), \PDO::PARAM_STR);
        $query->bindValue(":pseudo", $user->getPseudo(), \PDO::PARAM_STR);
        $query->bindValue(":password", $user->getPassword(), \PDO::PARAM_STR);

        return $result = $query->execute();
    }

    public function updateUser(User $user)
    {

    }

    public function deleteUser($user)
    {
        $query = parent::$_dbh->prepare("
            DELETE FROM users
            WHERE user_id = :id
            OR pseudo = :pseudo
            OR email = :email
        ");

        $query->bindValue(":id", $user, \PDO::PARAM_INT);
        $query->bindValue(":pseudo", $user, \PDO::PARAM_STR);
        $query->bindValue(":email", $user, \PDO::PARAM_STR);

        return $result = $query->execute();
    }

}