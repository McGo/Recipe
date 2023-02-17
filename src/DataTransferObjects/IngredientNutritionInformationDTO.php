<?php

namespace McGo\Recipe\DataTransferObjects;

use McGo\Recipe\Models\Ingredient;
use McGo\Recipe\Models\Unit;

class IngredientNutritionInformationDTO
{
    public Ingredient $ingredient;
    public Unit $unit;
    public $amount;

    public $nutrition_information;


    public function setNutritionInformationByGramm(NutritionInformationDTO $dto, $gramm)
    {
        $_clone = clone $dto;
        if (!is_null($dto->values_per_g) && $dto->values_per_g > 0) {
            $_faktor = $gramm / $dto->values_per_g;
            $_clone->values_per_g = $dto->values_per_g * $_faktor;
            $_clone->eiweiss_g = $dto->eiweiss_g * $_faktor;
            $_clone->fett_g = $dto->fett_g * $_faktor;
            $_clone->kohlenhydrate_g = $dto->kohlenhydrate_g * $_faktor;
            $_clone->calories = $dto->calories * $_faktor;
            $_clone->ballaststoffe_g = $dto->ballaststoffe_g * $_faktor;
            $_clone->zucker_g = $dto->zucker_g * $_faktor;
        }
        $this->nutrition_information = $_clone;
    }
}
