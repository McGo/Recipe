<?php

namespace McGo\Recipe\Traits;


use McGo\Recipe\DataTransferObjects\DefaultSeeder\Breed;
use McGo\Recipe\DataTransferObjects\DefaultSeeder\Food;

trait IngredientCategoryDefinition
{
    public function getIngredientCategoryDefinitions(): array
    {
        return [
            'Fleisch, Wurst, Fisch und Ei' => [
                'Fleisch und Fleischerzeugnisse',
                'Fisch und Fischerzeugnisse',
                'Wildfleisch und Wildfleischerzeugnisse',
                'Eier und Eiprodukte',
                'Tofu, Sofaprodukte und Vergleichbares'
            ],
            'Milch, Milcherzeugnisse & Käse' => [
                'Milch',
                'Milcherzeugniss',
                'Käse'
            ],
            'Brot, Getreide und Beilagen' => [
                'Getreide & Getreideerzeugnisse',
                'Hülsenfrüchte'
            ],
            'Öle und Fette' => [],
            'Obst, Gemüse und Salat' => [
                'Obst',
                'Gemüse',
                'Kräuter',
                'Pilze und Pilzerzeugnisse',
                'Nüsse und Samen'
            ],
            'Getränke' => [],
            'Gewürze, Würzmittel und Aromen' => [],
            'Verarbeitete Lebensmittel' => [],
        ];
    }
}