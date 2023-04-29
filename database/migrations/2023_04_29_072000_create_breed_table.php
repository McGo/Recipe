<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('mcgo_recipe_ingredienttype_foodbreed', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ingredient_parent_id')->unsigned()->nullable();
        });
    }
};
