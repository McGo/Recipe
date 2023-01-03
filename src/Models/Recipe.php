<?php

namespace McGo\Recipe\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public $timestamps = false;
    protected $table = 'mcgo_recipe_recipes';
    protected $guarded = [];
}