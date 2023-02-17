<?php

namespace McGo\Recipe\Actions;

use McGo\Recipe\DataTransferObjects\IngredientNutritionInformationDTO;
use McGo\Recipe\DataTransferObjects\NutritionInformationDTO;
use McGo\Recipe\Models\Ingredient;
use McGo\Recipe\Models\Unit;

class GetIngredientNutritionInformationDTOForIngredientUnitAmount
{
    public function execute(Ingredient $ingredient, Unit $unit, $amount)
    {
        $ingredient->load('nutrition_information');
        $dto = new IngredientNutritionInformationDTO();

        $nutrition = NutritionInformationDTO::fromModel($ingredient->nutrition_information);
        $gramm = $unit->in_g * $amount;
        $dto->setNutritionInformationByGramm($nutrition, $gramm);
        return $dto;
    }
}