<?php

namespace App;

use Symfony\Component\Yaml\Yaml;

class Config
{
    private $settings = [];
    private $configFile;
    private static $_instance;

    protected function __construct()
    {
        if(is_null(self::$_instance)) {
            $this->configFile = Yaml::parseFile(ROOT . "/App/Config/config.yaml");

            foreach ($this->configFile as $key => $value) {
                foreach ($value as $k => $v) {
                    $this->settings[$k] = $v;
                }
            }
        }
    }

    public static function getInstance()
    {
        if(is_null(self::$_instance)) {
            self::$_instance = new Config();
        }
        return self::$_instance;
    }

    public function getAllowedPostsImgType()
    {
        $allowedTypes = [];
        foreach ($this->settings["postsImg"] as $type) {
            $allowedTypes[] = constant("IMAGETYPE_".strtoupper($type));
        }

        return $allowedTypes;
    }

    public function get($key) {
        if(!array_key_exists($key, $this->settings)) {
            return false;
        }
        return $this->settings[$key];
    }
}