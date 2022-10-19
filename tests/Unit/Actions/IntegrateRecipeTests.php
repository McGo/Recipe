<?php

namespace McGo\Recipe\Tests\Unit\Actions;

use McGo\Recipe\Actions\IntegrateRecipe;
use McGo\Recipe\Exceptions\NoRecipeAtURLFoundException;
use McGo\Recipe\Tests\RecipeBaseTestClass;

/**
 * @coversDefaultClass \McGo\Recipe\Actions\IntegrateRecipe
 */
class IntegrateRecipeTests extends RecipeBaseTestClass
{
    /**
     * @return void
     * @covers ::fromHTMLString
     * @test
     */
    public function it_throws_exception_for_empty_html()
    {
        // Given
        $html = file_get_contents($this->getSampleRecipesFolder().'empty-html.html');

        // When & Then
        $this->expectException(NoRecipeAtURLFoundException::class);
        (new IntegrateRecipe())->fromHTMLString($html);
    }
}