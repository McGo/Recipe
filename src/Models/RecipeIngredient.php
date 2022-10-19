<?php

namespace McGo\Recipe\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RecipeIngredient extends Pivot
{
    public $timestamps = false;
    protected $table = 'mcgo_recipe_recipe_ingredients';
    // Amount is attribute
    // addition is attribute

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}