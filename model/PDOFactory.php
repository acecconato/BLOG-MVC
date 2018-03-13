<?php

namespace Model;

abstract class PDOFactory
{
    private static $_host      = "localhost";
    private static $_dbname    = "perso_blog";
    private static $_user      = "root";
    private static $_password  = "";

    protected static function PDOConnect()
    {
        try {
            $pdoConnexion = new \PDO("mysql:host=" . self::$_host . ";dbname=" . self::$_dbname, self::$_user, self::$_password);
            $pdoConnexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $pdoConnexion;
        } catch (\PDOException $e) {
            die("Error : " . $e->getMessage());
        }
    }
}