<?php

namespace McGo\Recipe\Actions;

use Brick\Schema\SchemaReader;
use Brick\Schema\Interfaces as Schema;
use McGo\Recipe\Exceptions\NoRecipeAtURLFoundException;

class IntegrateRecipe
{
    /**
     * @throws NoRecipeAtURLFoundException
     */
    public function fromURL($url)
    {
        $html = file_get_contents($url);
        $this->fromHTMLString($html, $url);
    }

    /**
     * @throws NoRecipeAtURLFoundException
     */
    public function fromHTMLString($html, $url = '') {
        $schemaReader = SchemaReader::forAllFormats();
        $candidates = $schemaReader->readHtml($html, $url);
        $recipe = null;
        foreach ($candidates as $candidate) {
            if ($candidate instanceof Schema\Recipe) {
                $recipe = $candidate;
            }
        }
        if (is_null($recipe)) {
            throw new NoRecipeAtURLFoundException($url);
        }
    }
}