<?php

namespace McGo\Recipe\Schema;

class RecipeIngredient
{
    public $amount = null;
    public $unit = null;
    public $ingredient = null;
    public $addition = null;

    public function setIngredient($text)
    {
        $this->ingredient = new Ingredient($text);
    }

    public function setUnit($unit)
    {
        $this->unit = new Unit($unit);
    }
}