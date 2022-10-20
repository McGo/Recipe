<?php

namespace McGo\Recipe\Models\IngredientTypes;

use McGo\Recipe\Models\Ingredient;

abstract class IsIngredientType extends \Illuminate\Database\Eloquent\Model
{

    /**
     * Each ingredient type is attached to an ingredient
     *
     * @return mixed
     */
    public function ingredient()
    {
        return $this->morphOne(Ingredient::class, 'ingredienttype')->withoutGlobalScopes();
    }
}