<?php

namespace McGo\Recipe\Actions;

use McGo\Recipe\Models\Ingredient;
use McGo\Recipe\Models\IngredientTypes\Food;

class CreateOrLoadIngredientByName
{
    public function execute($name, $type = Food::class, $typeattributes = [])
    {
        $ingredient = Ingredient::where('name', '=', $name)->first();
        if (is_null($ingredient)) {
            $ingredient_type = $type::create($typeattributes);
            $ingredient = Ingredient::create([
                'name' => $name,
                'ingredienttype_type' => get_class($ingredient_type),
                'ingredienttype_id' => $ingredient_type->id,
            ]);
        }
        return $ingredient;
    }
}