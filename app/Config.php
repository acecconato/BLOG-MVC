<?php

namespace App;

/**
 * Class Config
 * @package App
 * Singleton configuration file
 */
class Config
{
    private $settings = [];
    private static $_instance;

    protected function __construct()
    {
        if(is_null(self::$_instance)) {
            $this->settings = require dirname(__DIR__) . "/config.php";
        }
    }

    protected static function getInstance()
    {
        if(is_null(self::$_instance)) {
            self::$_instance = new Config();
        }
        return self::$_instance;
    }

    protected function get($key) {
        if(!isset($this->settings[$key])) {
            return null;
        }
        return $this->settings[$key];
    }
}