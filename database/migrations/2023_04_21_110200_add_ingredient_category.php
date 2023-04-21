<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('mcgo_recipe_ingredient_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('parent_id')->nullable()->unsigned();
        });

        Schema::table('mcgo_recipe_ingredients', function (Blueprint $table) {
            $table->bigInteger('category_id')->nullable()->after('description');
        });
    }
};
