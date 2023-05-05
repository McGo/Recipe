<?php

namespace McGo\Recipe\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use McGo\Recipe\Factories\RecipeFactory;
use McGo\Recipe\Traits\HasNutritionInformation;

class Recipe extends Model
{
    use HasNutritionInformation, HasFactory;

    public $timestamps = false;
    protected $table = 'mcgo_recipe_recipes';
    protected $guarded = [];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'mcgo_recipe_recipe_ingredients', 'recipe_id', 'ingredient_id')->using(RecipeIngredient::class);
    }

    public static function newFactory()
    {
        return new RecipeFactory();
    }
}