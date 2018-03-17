<?php

namespace Model;

abstract class Manager
{
    protected $dbh;

    public function __construct($type = "mysql")
    {
        if(is_null($this->dbh)) {
            $this->dbh = PDOFactory::create($type);
        }
    }
}