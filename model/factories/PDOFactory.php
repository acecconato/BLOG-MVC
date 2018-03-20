<?php

namespace Model;

use App\Config;

abstract class PDOFactory
{
    public static function create($type)
    {
        $cfg = Config::getInstance();
        try {
            switch ($type) {
                case "mysql":
                     return new \PDO("mysql:host=" . $cfg->get('db_hostname') . ";dbname=" . $cfg->get('db_name'), $cfg->get('db_user'), $cfg->get('db_password'));
                default:
                    throw new \PDOException("Database type not found");
            }
        } catch (\PDOException $e) {
            die("Error : " . $e->getMessage());
        }
    }
}