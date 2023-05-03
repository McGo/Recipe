<?php

namespace McGo\Recipe\Observers;

use McGo\Recipe\Jobs\CalculateRecipeNutritionInformation;
use McGo\Recipe\Models\Ingredient;
use McGo\Recipe\Models\NutritionInformation;
use McGo\Recipe\Models\Recipe;
use McGo\Recipe\Models\RecipeIngredient;

class RecalculateRecipeNutritionAfterChangeOfIngredientNutritionObserver
{
    public function saving(NutritionInformation $information)
    {
        if ($information->nutriable_type == Ingredient::class) {
            $recipe_ids = RecipeIngredient::where('ingredient_id', '=', $information->nutriable_id)->get();
            foreach ($recipe_ids as $recipe_id) {
                $recipe = Recipe::withoutGlobalScopes()->find($recipe_id);
                dispatch(new CalculateRecipeNutritionInformation($recipe));
            }
        }
    }
}