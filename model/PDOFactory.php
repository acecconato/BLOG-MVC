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
        self::getPDO();
    }

    protected static function getPDO()
    {
        if(is_null(self::$_dbh)) {
            $cfg = Config::getInstance();
            try {
                self::$_dbh = new \PDO("mysql:host=" . $cfg->get('db_hostname') . ";dbname=" . $cfg->get('db_name'), $cfg->get('db_user'), $cfg->get('db_password'));
            } catch (\PDOException $e) {
                die("Error : " . $e->getMessage());
            }
        }
        return self::$_dbh;
    }
}