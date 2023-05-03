<?php

namespace McGo\Recipe\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use McGo\Recipe\Factories\RecipeIngredientFactory;

class RecipeIngredient extends Pivot
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'mcgo_recipe_recipe_ingredients';
    protected $guarded = [];

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

    public static function newFactory()
    {
        return new RecipeIngredientFactory();
    }
}