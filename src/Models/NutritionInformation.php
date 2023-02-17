<?php

namespace McGo\Recipe\Models;

use Illuminate\Database\Eloquent\Model;

class NutritionInformation extends Model
{
    public $timestamps = false;
    protected $table = 'mcgo_recipe_nutrition_informations';
    protected $guarded = [];
    protected $casts = [
        'values_per_g' => 'float',
        'calories' => 'float',
        'fett_g' => 'float',
        'kohlenhydrate_g' => 'float',
        'zucker_g' => 'float',
        'eiweiss_g' => 'float',
        'ballaststoffe_g' => 'float'
    ];

    public function nutriable()
    {
        return $this->morphTo();
    }
}
