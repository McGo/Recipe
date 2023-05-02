<?php

namespace McGo\Recipe\Traits;

use McGo\Recipe\DataTransferObjects\DefaultSeeder\Breed;
use McGo\Recipe\DataTransferObjects\DefaultSeeder\Food;

trait IngredientDefinition
{
    public function getIngredientDefinitions(): array
    {

        return [
            'food' => $this->getFoods(),
        ];
    }

    private function getFoods(): array
    {
        $data = [];

        $data[] = Food::name('Tomaten')
            ->inCategory('Gemüse')
            ->addBreed(Breed::name('Cherrytomaten')->addAlternative('Kirschtomaten'))
            ->addBreed(Breed::name('Strauchtomate'))
            ->addBreed(Breed::name('Fleischtomaten'));

        $data[] = Food::name('Gurken')
            ->inCategory('Gemüse')
            ->addAlternative('Salatgurke');

        $data[] = Food::name('Essig')
            ->inCategory('Gewürze, Würzmittel und Aromen')
            ->addBreed(Breed::name('Apfelessig'))
            ->addBreed(Breed::name('Balsamico')->addAlternative('Balsamicoessig'));

        $data[] = Food::name('Brühe')
            ->inCategory('Gewürze, Würzmittel und Aromen')
            ->addBreed(Breed::name('Gemüsebrühe'))
            ->addBreed(Breed::name('Hühnerbrühe'))
            ->addBreed(Breed::name('Rinderbrühe'));

        $data[] = Food::name('Fonds')
            ->inCategory('Gewürze, Würzmittel und Aromen')
            ->addBreed(Breed::name('Gemüsefonds'))
            ->addBreed(Breed::name('Kalbsfonds'));

        return $data;

    }
}