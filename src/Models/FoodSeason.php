<?php

namespace McGo\Recipe\Models;

use Illuminate\Database\Eloquent\Model;
use McGo\Recipe\Models\IngredientTypes\Food;

class FoodSeason extends Model
{
    protected $table = 'mcgo_recipe_ingredientfood_season';
    protected $guarded = [];

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

}