<?php

namespace McGo\Recipe\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use McGo\Recipe\Models\IngredientTypes\Food;

class FoodFactory extends Factory
{
    protected $model = Food::class;

    public function definition(): array
    {
        return [];
    }
}