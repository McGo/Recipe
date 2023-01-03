<?php

namespace McGo\Recipe\Actions;

use McGo\Recipe\Schema;
use McGo\Recipe\Models;

class CreateRecipeModelFromSchema
{
    private Models\Recipe $model;
    private Schema\Recipe $schema;

    public function execute(Schema\Recipe $schema, $source_name = null, $source_url = null)
    {
        $this->schema = $schema;
        $this->createOrUpdateModel($source_name, $source_url);
        // Todo ingredients and nutrition info
        $this->createOrUpdateIngredients();
        return $this->model;
    }

    private function createOrUpdateModel(mixed $source_name, mixed $source_url)
    {

        if (!is_null($source_url)) {
            $existing = Models\Recipe::where('source_url', '=', $source_url)->first();
            if (!is_null($existing)) {
                // Update existing
                $existing->update([
                    'name' => $this->schema->name,
                    'description' => null,
                    'instructions' => $this->schema->instructions,
                    'prep_time_minutes' => $this->schema->prep_time_minutes,
                    'cook_time_minutes' => $this->schema->cook_time_minutes,
                    'total_time_minutes' => $this->schema->total_time_minutes,
                    'source_name' => $source_name,
                ]);
                $existing->refresh();
                $this->model = $existing;
                return;
            }
        }

        // Create new
        $this->model = Models\Recipe::create([
            'name' => $this->schema->name,
            'description' => null,
            'instructions' => $this->schema->instructions,
            'prep_time_minutes' => $this->schema->prep_time_minutes,
            'cook_time_minutes' => $this->schema->cook_time_minutes,
            'total_time_minutes' => $this->schema->total_time_minutes,
            'source_name' => $source_name,
            'source_url' => $source_url,
        ]);
    }

    private function createOrUpdateIngredients()
    {
        $existing_ingredients = Models\RecipeIngredient::where('recipe_id', '=', $this->model->id)->get();
        foreach ($existing_ingredients as $existing_ingredient) {
            $existing_ingredient->delete();
        }

        foreach ($this->schema->ingredients as $recipe_ingredient) {
            $ingredient_model = $recipe_ingredient->ingredient_model;
            if (is_null($ingredient_model)) {
                $ingredient_model = (new CreateOrLoadIngredientByName())->execute($recipe_ingredient->ingredient->name);
            }
            $ingredient_id = $ingredient_model->id;
            $unit_id = is_null($recipe_ingredient->unit_model) ? null : $recipe_ingredient->unit_model->id;

            Models\RecipeIngredient::create([
                'recipe_id' => $this->model->id,
                'unit_id' => $unit_id,
                'ingredient_id' => $ingredient_id,
                'amount' => $recipe_ingredient->amount,
            ]);
        }
    }
}