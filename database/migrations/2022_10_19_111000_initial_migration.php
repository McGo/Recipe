<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('mcgo_recipe_recipes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('source_name')->nullable();
            $table->string('source_url')->nullable();
            $table->integer('servings')->unsigned()->nullable();
        });
        Schema::create('mcgo_recipe_ingredients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('ingredient_type')->nullable();
            $table->bigInteger('ingredient_id')->unsigned()->nullable();
        });
        Schema::create('mcgo_recipe_recipe_ingredients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('recipe_id')->nullable()->unsigned();
            $table->decimal('amount')->unsigned()->nullable();
            $table->bigInteger('unit_id')->nullable()->unsigned();
            $table->bigInteger('ingredient_id')->nullable()->unsigned();
        });
        Schema::create('mcgo_recipe_units', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->decimal('in_g')->unsigned()->default(0);
            $table->text('description')->nullable();
        });
        Schema::create('mcgo_recipe_nutrition_informations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ingredient_id')->nullable()->unsigned();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trm_form_contact');
    }
};
