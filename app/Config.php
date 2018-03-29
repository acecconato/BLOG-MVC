<?php

namespace App;

class Config
{
    private $settings = [];
    private $configFile;
    private static $_instance;

    protected function __construct()
    {
        if(is_null(self::$_instance)) {
            $this->configFile = new \DOMDocument();
            $this->configFile->load(__DIR__."/../app/config/configuration.xml");

            $elements = $this->configFile->getElementsByTagName("*");

            /** @var \DOMElement $element */
            foreach ($elements as $element) {
                $this->settings[$element->getAttribute("var")] = $element->getAttribute("value");
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

    public function get($key) {
        if(!isset($this->settings[$key])) {
            return null;
        }
        return $this->settings[$key];
    }
}