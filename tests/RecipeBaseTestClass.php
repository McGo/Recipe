<?php
namespace McGo\Recipe\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use McGo\Recipe\RecipeServiceProvider;
use Orchestra\Testbench\TestCase;

use McGo\Recipe\Actions\ParseRecipe;

class RecipeBaseTestClass extends TestCase
{
    use RefreshDatabase;

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