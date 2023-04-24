<?php

namespace McGo\Recipe;

use Illuminate\Support\ServiceProvider;
use McGo\Recipe\Models\Recipe;
use McGo\Recipe\Observers\CreateSlugForRecipe;

class RecipeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        Recipe::observe(CreateSlugForRecipe::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }
}