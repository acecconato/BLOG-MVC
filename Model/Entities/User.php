<?php

namespace Model\Entities;

class User extends Entity
{
    private $user_id,
            $permissionLevel,
            $email,
            $pseudo,
            $password,
            $creationDate;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function setUser_id($userId)
    {
        $this->user_id = (int) $userId;
    }

    public function setPermissionLevel($permLevel)
    {
        if((int) $permLevel >= 0) {
            $this->permissionLevel = $permLevel;
        }
    }

    public function setEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        }
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setCreationDate($date)
    {
        $this->creationDate = $date;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    public function getPermissionLevel()
    {
        return $this->permissionLevel;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }
}