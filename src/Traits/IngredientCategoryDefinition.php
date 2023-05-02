<?php

namespace McGo\Recipe\Traits;


use McGo\Recipe\DataTransferObjects\DefaultSeeder\Breed;
use McGo\Recipe\DataTransferObjects\DefaultSeeder\Food;

trait IngredientCategoryDefinition
{
    public function getIngredientCategoryDefinitions(): array
    {
        return [
            'food' => $this->getFoods(),
        ];
    }

    private function getFoods(): array
    {
        $data = [];

        $data[] = Food::name('Tomaten')
            ->inCategory('Obst & Gemüse')
            ->addBreed(Breed::name('Cherrytomaten')->addAlternative('Kirschtomaten'))
            ->addBreed(Breed::name('Strauchtomate'))
            ->addBreed(Breed::name('Fleischtomaten'));

        $data[] = Food::name('Gurken')
            ->inCategory('Obst & Gemüse')
            ->addAlternative('Salatgurke');

        return $data;
    }
}