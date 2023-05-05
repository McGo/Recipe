<?php

namespace McGo\Recipe\Models\IngredientTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use McGo\Recipe\Factories\FoodFactory;
use McGo\Recipe\Models\FoodSeason;

class Food extends IsIngredientType
{
    use HasFactory;

    protected $table = 'mcgo_recipe_ingredienttype_food';
    public $timestamps = false;
    protected $guarded = [];

    public function seasons()
    {
        return $this->hasMany(FoodSeason::class);
    }

    protected static function newFactory()
    {
        return new FoodFactory();
    }
}