<?php

namespace McGo\Recipe\Schema;

class RecipeIngredient
{
    public $amount = null;
    public $unit = null;
    public $unit_model = null;
    public $ingredient = null;
    public $ingredient_model = null;
    public $addition = null;

    public function setIngredient($text, $model = null)
    {
        $this->ingredient = new Ingredient($text);
        $this->ingredient_model = $model;
    }

    public function setUnit($unit, $model = null)
    {
        $this->unit = new Unit($unit);
        $this->unit_model = $model;
    }
}