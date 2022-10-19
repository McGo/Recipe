<?php

namespace McGo\Recipe\Schema;

class Ingredient
{
    public $name;

    public function __construct($text)
    {
        $this->name = $text;
    }
}