<?php

namespace McGo\Recipe\Traits;

use McGo\Recipe\Models\NutritionInformation;

trait HasNutritionInformation
{
    public function nutrition_information()
    {
        return $this->morphOne(NutritionInformation::class, 'nutriable')->withoutGlobalScopes();
    }
}