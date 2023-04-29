<?php

namespace McGo\Recipe\Actions;

use McGo\Recipe\Models\Ingredient;
use McGo\Recipe\Models\IngredientTypes\FoodBreed;

class CreateBreedForFoodIngredient
{
    public function execute(Ingredient $ingredient, $name, $description = null)
    {
        $type = FoodBreed::create(['ingredient_parent_id' => $ingredient->id]);
        $breed = Ingredient::create([
            'name' => $name,
            'description' => $description,
            'ingredienttype_type' => FoodBreed::class,
            'ingredienttype_id' => $type->id,
        ]);
        return $breed;
    }
}