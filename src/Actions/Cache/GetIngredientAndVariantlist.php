<?php

namespace McGo\Recipe\Actions\Cache;

use McGo\Recipe\Models\Ingredient;
use McGo\Recipe\Models\IngredientAlternative;

/**
 * Build a (cached) list of all Ingredients and their variants.
 */
class GetIngredientAndVariantlist
{
    public function execute($cached = true)
    {
        // TODO Caching
        return $this->queryIngredients();
    }

    private function queryIngredients() {
        $ingredients = Ingredient::all()
            ->pluck('name', 'id');

        $alternatives = IngredientAlternative::all()
            ->pluck('name', 'ingredient_id');

        return array_merge($alternatives, $ingredients);
    }
}