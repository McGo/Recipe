<?php

namespace McGo\Recipe\Models\IngredientTypes;

class Nourishment extends IsIngredientType
{
    protected $table = 'mcgo_recipe_ingredienttype_nourishment';
    public $timestamps = false;
}