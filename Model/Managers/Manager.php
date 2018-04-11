<?php

namespace Model\Managers;

use App\Config;
use Model\Factories\PDOFactory;

abstract class Manager
{
    protected $dbh;
    private static $_defaultType;
    private static $managers = [];

    public function __construct($type = null)
    {
        $this->setDefaultType();
        (is_null($type)) ? $this->dbh = PDOFactory::create($this->getDefaultType()) : $this->dbh = PDOFactory::create($type);
    }

    public static function getManagerOf($name)
    {
        $name = strtolower($name);
        if(!isset(self::$managers[$name])) {
            $managerToLoad = "\\Model\\Managers\\" . ucfirst($name) . "Manager";
            if(!class_exists($managerToLoad)) {
                throw new \BadFunctionCallException("The manager doesn't exist");
            }
            self::$managers[$name] = new $managerToLoad();
        }
        return self::$managers[$name];
    }

    private function setDefaultType()
    {
        if(is_null(self::$_defaultType)) {
            self::$_defaultType = Config::getInstance()->get('default_sql_type');
        }
    }

    private function getDefaultType()
    {
        return self::$_defaultType;
    }
}