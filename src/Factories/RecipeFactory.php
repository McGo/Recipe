<?php

namespace McGo\Recipe\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use McGo\Recipe\Models\Recipe;

class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    public function definition(): array
    {
        return [
            'user_id' => null,
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
            'instructions' => $this->faker->sentence,
            'prep_time_minutes' => $this->faker->numberBetween(0,60),
            'cook_time_minutes' => $this->faker->numberBetween(0,60),
            'total_time_minutes' => $this->faker->numberBetween(0,60),
            'source_name' => $this->faker->company,
            'source_url' => $this->faker->url,
            'servings' => $this->faker->numberBetween(1,4)
        ];
    }
}
