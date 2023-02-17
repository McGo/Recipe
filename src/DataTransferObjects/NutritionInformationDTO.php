<?php

namespace McGo\Recipe\DataTransferObjects;

class NutritionInformationDTO
{
    public $values_per_g = null;
    public $calories = null;
    public $fett_g = null;
    public $kohlenhydrate_g = null;
    public $zucker_g = null;
    public $eiweiss_g = null;
    public $ballaststoffe_g = null;

    public static function fromModel(\McGo\Recipe\Models\NutritionInformation $nutrition = null)
    {
        $dto = new self;
        if (!is_null($nutrition)) {
            $dto->values_per_g = $nutrition->values_per_g;
            $dto->calories = $nutrition->calories;
            $dto->fett_g = $nutrition->fett_g;
            $dto->kohlenhydrate_g = $nutrition->kohlenhydrate_g;
            $dto->zucker_g = $nutrition->zucker_g;
            $dto->eiweiss_g = $nutrition->eiweiss_g;
            $dto->ballaststoffe_g = $nutrition->ballaststoffe_g;
        }
        return $dto;
    }
}