<?php

namespace McGo\Recipe\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use McGo\Recipe\Models\Ingredient;
use McGo\Recipe\Models\IngredientTypes\Food;

class IngredientFactory extends Factory
{
    protected $model = Ingredient::class;

    public function definition(): array
    {
        $foodtypes = [
            Food::class,
            //FoodBreed::class,
            //Nourishment::class,
        ];
        $foodtype = Arr::random($foodtypes)::factory()->create();

        return [
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
            'category_id' => null,
            'ingredienttype_type' => $foodtype->getMorphClass(),
            'ingredienttype_id' => $foodtype->getKey(),
        ];
    }
}