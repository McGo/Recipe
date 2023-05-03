<?php

namespace Unit\Models;

use Illuminate\Support\Str;
use McGo\Recipe\Models\Ingredient;
use McGo\Recipe\Models\Recipe;
use McGo\Recipe\Models\RecipeIngredient;
use McGo\Recipe\Tests\RecipeBaseTestClass;

/**
 * @coversDefaultClass \McGo\Recipe\Models\Recipe
 */
class RecipeTests extends RecipeBaseTestClass
{
    /**
     * @test
     * @coversNothing
     */
    public function the_factory_works()
    {
        $this->assertCount(0, Recipe::all());
        Recipe::factory()->create();
        $this->assertCount(1, Recipe::all());
    }

    /**
     * @test
     * @coversNothing
     */
    public function slug_will_be_generated()
    {
        $this->assertCount(0, Recipe::all());
        $recipe = Recipe::factory()->create();
        $name = $recipe->name;
        $this->assertEquals(Str::slug($name), $recipe->slug);
    }

    /**
     * @test
     * @covers ::ingredients
     */
    public function the_relation_to_ingredients_work()
    {
        $recipe = Recipe::factory()->create();
        $count = rand(2,6);
        $ingredients = Ingredient::factory()->count($count)->create();
        foreach ($ingredients as $ingredient) {
            RecipeIngredient::factory()->create(['ingredient_id' => $ingredient->id, 'recipe_id' => $recipe->id]);
        }

        $this->assertCount(1, Recipe::all());
        $this->assertCount($count, Ingredient::all());
        $this->assertCount($count, RecipeIngredient::all());
        $this->assertCount($count, $recipe->ingredients);
    }
}