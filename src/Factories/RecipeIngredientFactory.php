<?php

namespace McGo\Recipe\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use McGo\Recipe\Models\RecipeIngredient;

class RecipeIngredientFactory extends Factory
{
    protected $model = RecipeIngredient::class;

    public function definition(): array
    {
        return [
            'recipe_id' => null,
            'ingredient_id' => null,
            'unit_id' => null,
            'amount' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
