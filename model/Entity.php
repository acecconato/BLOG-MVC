<?php

namespace Model;

abstract class Entity
{
    protected function hydrate(array $data)
    {
        foreach ($data as $attribute => $value) {
            $method = "set" . ucfirst($attribute);
            if(is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }
}