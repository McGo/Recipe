<?php

namespace McGo\Recipe\Schema;

use Brick\Schema\Interfaces as Schema;
use McGo\Recipe\Actions\ConvertIngredientText;

class Recipe
{
    public $name;
    public $instructions;

    public $prep_time_minutes;
    public $cook_time_minutes;
    public $total_time_minutes;

    public $ingredients;

    public $servings;

    public $images;
    public $tags;

    public static function parseFromSchema(Schema\Recipe $recipe)
    {
        $instance = new self;

        $instance->name = $recipe->name->getValues();
        $instance->description = $recipe->description->getValues();
        $instance->instructions = $recipe->recipeInstructions->getValues();
        $instance->images = $recipe->image->getValues();
        $instance->tags = $recipe->recipeCategory->getValues();
        $instance->prep_time_minutes = $instance->convertDurationToMinutes($recipe->prepTime->getValues());
        $instance->cook_time_minutes = $instance->convertDurationToMinutes($recipe->cookTime->getValues());
        $instance->total_time_minutes = $instance->convertDurationToMinutes($recipe->totalTime->getValues());
        $instance->servings = $recipe->recipeYield->getValues();

        $ingredients = $recipe->recipeIngredient->getValues();
        $instance->ingredients = [];
        foreach ($ingredients as $candidate) {
            $instance->ingredients[] = (new ConvertIngredientText())->execute($candidate);
        }

        dump($instance);

        return $instance;

    }

    public function persistRecipe($create_ingredients = true)
    {

    }

    private function convertDurationToMinutes($duration) {
        $duration = is_array($duration) ? $duration[0] : $duration;
        preg_match('/P\d+DT(\d+)H(\d+)M/', $duration, $matches);
        if (count($matches) == 3) {
            return $matches[1] * 60 + $matches[2];
        }

        return null;
    }
}