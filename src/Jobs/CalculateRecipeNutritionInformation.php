<?php

namespace McGo\Recipe\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use McGo\Recipe\Models\Recipe;

class CalculateRecipeNutritionInformation  implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels, Dispatchable;

    protected $recipe;

    public function __construct(Recipe $recipe)
    {
        $this->recipe = $recipe;
    }

    public function handle(): void
    {
        Log::info('CalculateRecipeNutritionInformation::Calculate nutrition information for recipe id '. $this->recipe->id);
    }
}
