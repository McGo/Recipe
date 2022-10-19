<?php

namespace McGo\Recipe\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'in_g', 'description'];
    protected $table = 'mcgo_recipe_units';
}