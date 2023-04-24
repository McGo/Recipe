<?php

namespace McGo\Recipe\Observers;

use Illuminate\Support\Str;
use McGo\Recipe\Models\Recipe;

class CreateSlugForRecipe
{
    public function saving(Recipe $recipe)
    {
        $recipe->slug = $this->createUniqueSlugForRecipe($recipe);
    }

    private function createUniqueSlugForRecipe(Recipe $recipe, $attempt = null): string
    {
        $nameslug = Str::slug($recipe->name);

        if ($nameslug == '') {
            $nameslug = $recipe->id;
        }
        if (! is_null($attempt)) {
            $nameslug .= '-'.$attempt;
            $next_attempt = $attempt + 1;
        } else {
            $next_attempt = 1;
        }

        $exists = Recipe::where('slug', '=', $nameslug)
            ->where('id', '!=', $recipe->id)
            ->first();
        if (! is_null($exists)) {
            return $this->createUniqueSlugForRecipe($recipe, $next_attempt);
        }

        return $nameslug;
    }
}
