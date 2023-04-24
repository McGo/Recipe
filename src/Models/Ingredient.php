<?php

namespace McGo\Recipe\Models;

use Illuminate\Database\Eloquent\Model;
use McGo\Recipe\Traits\HasNutritionInformation;

class Ingredient extends Model
{
    use HasNutritionInformation;

    public $timestamps = false;
    protected $table = 'mcgo_recipe_ingredients';
    protected $guarded = [];

    /**
     * Each Ingredient is attached to an ingredienttype.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function ingredienttype()
    {
        return $this->morphTo();
    }


    public function alternatives()
    {
        return $this->hasMany(IngredientAlternative::class, 'ingredient_id');
    }
}