<?php

namespace McGo\Recipe\Observers;

use Illuminate\Support\Str;
use McGo\Recipe\Models\Ingredient;
use McGo\Recipe\Models\Recipe;

class CreateSlugForIngredient
{
    public function saving(Ingredient $ingredient)
    {
        $ingredient->slug = $this->createUniqueSlugForIngredient($ingredient);
    }

    private function createUniqueSlugForIngredient(Ingredient $ingredient, $attempt = null): string
    {
        $nameslug = Str::slug($ingredient->name);

        if ($nameslug == '') {
            $nameslug = $ingredient->id;
        }
        if (! is_null($attempt)) {
            $nameslug .= '-'.$attempt;
            $next_attempt = $attempt + 1;
        } else {
            $next_attempt = 1;
        }

        $exists = Ingredient::where('slug', '=', $nameslug)
            ->where('id', '!=', $ingredient->id)
            ->first();
        if (! is_null($exists)) {
            return $this->createUniqueSlugForIngredient($ingredient, $next_attempt);
        }

        return $nameslug;
    }
}