<?php

namespace Model;

class User extends Entity
{
    private $userId,
            $permissionLevel,
            $email,
            $pseudo,
            $password,
            $creationDate;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function getPermissionLevel()
    {
        return $this->permissionLevel;
    }

    public function setPermissionLevel($permissionLevel)
    {
        $permissionLevel = (int) $permissionLevel;
        if($permissionLevel >= 0) {
            $this->permissionLevel = $permissionLevel;
        }
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        }
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        if(is_string($pseudo)) {
            $this->pseudo = $pseudo;
        }
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        if(is_string($password)) {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
        }
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $userId = (int) $userId;
        if($userId >= 0) {
            $this->userId = $userId;
        }
    }
}