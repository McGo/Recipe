<?php

namespace McGo\Recipe\DataTransferObjects\DefaultSeeder;

use McGo\Recipe\Models\Ingredient;
use McGo\Recipe\Models\IngredientAlternative;

class Food
{
    public $name;
    public $category;
    public $breeds = [];
    public $alternatives = [];
    public $nutrition = null;

    public function __construct($foodname)
    {
        $this->name = $foodname;
    }

    public static function name($foodname)
    {
        return new Food($foodname);
    }

    public function inCategory($categoryname)
    {
        $this->category = $categoryname;
        return $this;
    }

    public function addBreed(Breed $breed)
    {
        $this->breeds[] = $breed;
        return $this;
    }

    public function addAlternative($alternativename)
    {
        $this->alternatives[] = $alternativename;
        return $this;
    }

    public function addNutrition(Nutrition $nutrition)
    {
        $this->nutrition = $nutrition;
        return $this;
    }

    public function persist()
    {
        // Load the ingredient
        $_existing = Ingredient::where('name', '=', $this->name)
            ->where('ingredienttype_type', '=', \McGo\Recipe\Models\IngredientTypes\Food::class)
            ->first();
        if (is_null($_existing)) {
            $_type = \McGo\Recipe\Models\IngredientTypes\Food::create();
            $_existing = Ingredient::create([
                'name' => $this->name,
                'ingredienttype_type' => get_class($_type),
                'ingredienttype_id' => $_type->id,
            ]);
        }

        // Add Alternatives
        foreach ($this->alternatives as $alternative) {
            $this->createAlternativeForModel($_existing, $alternative);
        }


        foreach ($this->breeds as $breed) {
            $_existing_breed = Ingredient::where('name', '=', $breed->name)
                ->where('ingredienttype_type', '=', \McGo\Recipe\Models\IngredientTypes\FoodBreed::class)
                ->first();
            if (is_null($_existing_breed)) {
                $_type_breed = \McGo\Recipe\Models\IngredientTypes\FoodBreed::create(['ingredient_parent_id' => $_existing->id]);
                $_existing_breed = Ingredient::create([
                    'name' => $breed->name,
                    'ingredienttype_type' => get_class($_type_breed),
                    'ingredienttype_id' => $_type_breed->id,
                ]);
            }
            foreach ($breed->alternatives as $alternative) {
                $this->createAlternativeForModel($_existing_breed, $alternative);
            }
        }
    }

    private function createAlternativeForModel($model, $alternative_name, $alternative_description = null)
    {
        IngredientAlternative::updateOrCreate(['name' => $alternative_name], [
            'description' => $alternative_description,
            'ingredient_id' => $model->id
        ]);
    }
}