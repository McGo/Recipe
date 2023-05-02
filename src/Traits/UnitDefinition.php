<?php

namespace McGo\Recipe\Traits;

trait UnitDefinition
{
    public function getUnitDefinitions(): array
    {
        return [
            'EL' => 15,
            'Esslöffel' => 15,
            'TL' => 5,
            'Teelöffel' => 5,
            'l' => 1000,
            'ml' => 1,
            'Liter' => 1000,
            'kg' => 1000,
            'g' => 1,
            'mg' => .001,
            'Handvoll' => 75,

            'Prise' => 0,
            'Pck.' => 0,
            'Pck' => 0,
            'Packung' => 0,
            'Paket' => 0,
            'Becher' => 0,
            'nach Belieben' => 0,
        ];
    }
}