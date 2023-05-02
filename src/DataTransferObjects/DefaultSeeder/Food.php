<?php

namespace McGo\Recipe\DataTransferObjects\DefaultSeeder;

use McGo\Recipe\Models\Ingredient;

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

        }
    }
}