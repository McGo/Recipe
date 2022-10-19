<?php

namespace McGo\Recipe\Schema;

class Unit
{
    public $name;

    public function __construct($unit)
    {
        $this->name = $unit;
    }
}