<?php

namespace McGo\Recipe\Models;

use Illuminate\Database\Eloquent\Model;
use McGo\Recipe\Traits\HasNutritionInformation;

class Recipe extends Model
{
    use HasNutritionInformation;

    public $timestamps = false;
    protected $table = 'mcgo_recipe_recipes';
    protected $guarded = [];

    public function ingredients()
    {
        return $this->belongsToMany(RecipeIngredient::class)->using(RecipeIngredient::class);
    }
}