<?php
namespace McGo\Recipe\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use McGo\Recipe\RecipeServiceProvider;
use Orchestra\Testbench\TestCase;

use McGo\Recipe\Actions\ParseRecipe;

class RecipeBaseTestClass extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     * @throws \McGo\Recipe\Exceptions\NoRecipeAtURLFoundException
     * @test
     */
    public function it_works()
    {

        $url = "https://www.chefkoch.de/rezepte/1230931228138185/Puszta-Carbonara.html";

        $recipe = ParseRecipe::fromURL($url);

    }
    public function getSampleRecipesFolder()
    {
        return __DIR__ . '/Mocks/Recipes/';
    }

    protected function getPackageProviders($app)
    {
        return [
            RecipeServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {

        $app['config']->set('database.default', 'testdb');
        $app['config']->set('database.connections.testdb', [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);
    }
}