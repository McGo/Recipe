<?php

namespace McGo\Recipe\DataTransferObjects\DefaultSeeder;

class Food
{
    public $name;
    public $category;
    public $breeds = [];
    public $alternatives = [];
    public $nutrition = null;


    public function __construct($foodname)
    {
        $this->name = $foodname;
    }

    public static function name($foodname)
    {
        return new Food($foodname);
    }

    public function inCategory($categoryname)
    {
        $this->category = $categoryname;
        return $this;
    }

    public function addBreed(Breed $breed)
    {
        $this->breeds[] = $breed;
        return $this;
    }

    public function addAlternative($alternativename)
    {
        $this->alternatives[] = $alternativename;
        return $this;
    }

    public function addNutrition(Nutrition $nutrition) {
        $this->nutrition = $nutrition;
        return $this;
    }
}