<?php

namespace Model\Factories;

use App\Config;

abstract class PDOFactory
{
    public static function create($type)
    {
        $cfg = Config::getInstance();
        try {
            switch ($type) {
                case "mysql":
                     return new \PDO("mysql:host=" . $cfg->get('hostname') . ";dbname=" . $cfg->get('dbname'), $cfg->get('username'), $cfg->get('password'));
                default:
                    throw new \PDOException("Database type not found");
            }
        } catch (\PDOException $e) {
            die("Error : " . $e->getMessage());
        }
    }
}