<?php

namespace Model;

use App\Config;

abstract class PDOFactory extends Config
{
    /* @var \PDO $_dbh */
    protected static $_dbh;

    protected function __construct()
    {
        parent::__construct();
        self::DBConnect("mysql");
    }

    protected static function DBConnect($type)
    {
        if(is_null(self::$_dbh)) {
            $cfg = Config::getInstance();
            try {
                switch($type) {
                    case "mysql":
                        self::$_dbh = new \PDO("mysql:host=" . $cfg->get('db_hostname') . ";dbname=" . $cfg->get('db_name'), $cfg->get('db_user'), $cfg->get('db_password'));
                        break;
                    default:
                        throw new \PDOException("Database type not found");
                }
            } catch (\PDOException $e) {
                die("Error : " . $e->getMessage());
            }
        }
        return self::$_dbh;
    }
}