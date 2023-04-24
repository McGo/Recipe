<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('mcgo_recipe_recipes', function (Blueprint $table) {
            $table->integer('status')->after('name')->nullable()->unsigned();
            $table->string('slug')->after('id')->nullable();
        });
    }
};
