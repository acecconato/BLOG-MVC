<?php

namespace Model;

use App\Config;

abstract class Manager
{
    protected $dbh;
    private static $_defaultType;

    protected function __construct()
    {
        $this->setDefaultType();
        $this->dbh = PDOFactory::create($this->getDefaultType());
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