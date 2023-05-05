<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use McGo\Recipe\Models\IngredientCategory;
use McGo\Recipe\Models\Unit;
use McGo\Recipe\Traits\IngredientCategoryDefinition;
use McGo\Recipe\Traits\IngredientDefinition;
use McGo\Recipe\Traits\UnitDefinition;

class RecipeDefaultDataSeeder extends Seeder
{
    use UnitDefinition, IngredientDefinition, IngredientCategoryDefinition;

    public function run()
    {
        $this->integrateUnits();
        $this->integrateIngredientCategories();
        $this->integrateIngredients();
    }

    private function integrateUnits()
    {
        $units = $this->getUnitDefinitions();
        foreach ($units as $_name => $_in_g) {
            Unit::updateOrCreate(['name' => $_name], ['in_g' => $_in_g]);
        }
    }

    private function integrateIngredientCategories()
    {
        $categories = $this->getIngredientCategoryDefinitions();
        foreach ($categories as $category => $children) {
            $_parent = IngredientCategory::updateOrCreate(['name' => $category], ['parent_id' => null]);
            foreach ($children as $child) {
                IngredientCategory::updateOrCreate(['name' => $child], ['parent_id' => $_parent->id]);
            }
        }
    }

    private function integrateIngredients()
    {
        $ingredients = $this->getIngredientDefinitions();
        foreach ($ingredients as $ingredient) {
            $ingredient->persist();
        }
    }
}
