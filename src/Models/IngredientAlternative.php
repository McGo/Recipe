<?php

namespace McGo\Recipe\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Represents an alternative to an ingredient like Karotte, Möhre, Gelbe Rübe
 */
class IngredientAlternative extends Model
{
    protected $table = 'mcgo_recipe_ingredient_alternatives';
    protected $fillable = ['name', 'description', 'ingredient_id'];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}