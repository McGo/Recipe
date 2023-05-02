<?php

namespace McGo\Recipe\DataTransferObjects\DefaultSeeder;

class Breed extends Food
{
    public static function name($foodname)
    {
        return new Breed($foodname);
    }
}