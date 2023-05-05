<?php

namespace McGo\Recipe\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use McGo\Recipe\Factories\IngredientFactory;
use McGo\Recipe\Traits\HasNutritionInformation;

class Ingredient extends Model
{
    use HasNutritionInformation, HasFactory;

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

    public function category()
    {
        return $this->belongsTo(IngredientCategory::class, 'category_id');
    }

    public static function newFactory()
    {
        return new IngredientFactory();
    }
}