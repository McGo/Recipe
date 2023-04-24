<?php

namespace McGo\Recipe\Models;

use Illuminate\Database\Eloquent\Model;

class IngredientCategory extends Model
{
    protected $table = 'mcgo_recipe_ingredient_categories';
    public $timestamps = false;
    protected $guarded = [];

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class, 'category_id');
    }
}