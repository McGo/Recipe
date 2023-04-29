<?php

namespace McGo\Recipe\Models\IngredientTypes;

use McGo\Recipe\Models\FoodSeason;

class FoodBreed extends IsIngredientType
{
    protected $table = 'mcgo_recipe_ingredienttype_foodbreed';
    public $timestamps = false;
    protected $guarded = [];

    public function seasons()
    {
        return $this->hasMany(FoodSeason::class);
    }
}