<?php

namespace Model\Entities;

abstract class Entity
{
    /**
     * Automatically hydrates entities.
     * @param array $data
     */
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