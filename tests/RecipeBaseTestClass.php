<?php
namespace McGo\Recipe\Tests;

use Orchestra\Testbench\TestCase;

class RecipeBaseTestClass extends TestCase
{
    public function getSampleRecipesFolder()
    {
        return __DIR__ . '/Mocks/Recipes/';
    }

}