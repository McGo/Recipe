<?php

namespace McGo\Recipe\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public $timestamps = false;
    protected $table = 'mcgo_recipe_ingredients';
}