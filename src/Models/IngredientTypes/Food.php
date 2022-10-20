<?php

namespace McGo\Recipe\Models\IngredientTypes;

use McGo\Recipe\Models\FoodSeason;

class Food extends IsIngredientType
{
    protected $table = 'mcgo_recipe_ingredienttype_food';
    public $timestamps = false;

    public function seasons()
    {
        return $this->hasMany(FoodSeason::class);
    }
}