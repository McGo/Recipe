<?php

namespace McGo\Recipe\Actions;

use Brick\Schema\SchemaReader;
use Brick\Schema\Interfaces as Schema;
use McGo\Recipe\Exceptions\NoRecipeAtURLFoundException;
use McGo\Recipe\Schema\Recipe;

class ParseRecipe
{
    /**
     * @throws NoRecipeAtURLFoundException
     */
    public static function fromURL($url)
    {
        $html = file_get_contents($url);
        return self::fromHTMLString($html, $url);
    }

    /**
     * @throws NoRecipeAtURLFoundException
     */
    public static function fromHTMLString($html, $url = '')
    {
        $schemaReader = SchemaReader::forAllFormats();
        $candidates = $schemaReader->readHtml($html, $url);
        $recipe = null;
        foreach ($candidates as $candidate) {
            if ($candidate instanceof Schema\Recipe) {
                $recipe = Recipe::parseFromSchema($candidate);
            }
        }
        if (is_null($recipe)) {
            throw new NoRecipeAtURLFoundException($url);
        }

        // For now
        return $recipe;
    }

}