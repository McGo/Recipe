<?php

namespace McGo\Recipe\Actions;

use McGo\Recipe\Models\Ingredient;
use McGo\Recipe\Models\IngredientAlternative;

class CreateAlternativeForIngredient
{
    public function execute(Ingredient $ingredient, $name, $description = null)
    {
        return IngredientAlternative::create([
            'ingredient_id' => $ingredient->id,
            'name' => $name,
            'description' => $description
        ]);
    }
}