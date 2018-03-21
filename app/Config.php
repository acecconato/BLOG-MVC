<?php

namespace App;

class Config
{
    private $settings = [];
    private static $_instance;

    protected function __construct()
    {
        if(is_null(self::$_instance)) {
            $this->settings = require dirname(__DIR__) . "/app/config/config.php";
        }
    }

    public static function getInstance()
    {
        if(is_null(self::$_instance)) {
            self::$_instance = new Config();
        }
        return self::$_instance;
    }

    public function get($key) {
        if(!isset($this->settings[$key])) {
            return null;
        }
        return $this->settings[$key];
    }
}