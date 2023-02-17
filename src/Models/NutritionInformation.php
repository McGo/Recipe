<?php

namespace McGo\Recipe\Models;

use Illuminate\Database\Eloquent\Model;

class NutritionInformation extends Model
{
    public $timestamps = false;
    protected $table = 'mcgo_recipe_nutrition_informations';
    protected $guarded = [];

    public function nutriable()
    {
        return $this->morphTo();
    }
}