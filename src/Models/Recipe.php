<?php

namespace McGo\Recipe\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public $timestamps = false;
    protected $table = 'mcgo_recipe_recipes';
    protected $guarded = [];

    public function ingredients()
    {
        return $this->belongsToMany(RecipeIngredient::class)->using(RecipeIngredient::class);
    }
}