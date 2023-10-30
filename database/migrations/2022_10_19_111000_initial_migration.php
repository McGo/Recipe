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
            $table->text('instructions')->nullable();

            $table->integer('prep_time_minutes')->nullable();
            $table->integer('cook_time_minutes')->nullable();
            $table->integer('total_time_minutes')->nullable();

            $table->string('source_name')->nullable();
            $table->string('source_url')->nullable();

            $table->integer('servings')->unsigned()->nullable();
        });
        Schema::create('mcgo_recipe_ingredient_alternatives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('ingredient_id')->unsigned()->nullable();
        });

        Schema::create('mcgo_recipe_ingredients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('ingredienttype_type')->nullable();
            $table->bigInteger('ingredienttype_id')->unsigned()->nullable();
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
            $table->decimal('in_g', 8, 4)->unsigned()->default(0);
            $table->text('description')->nullable();
        });
        Schema::create('mcgo_recipe_ingredient_unit_weights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('unit_id')->nullable()->unsigned();
            $table->bigInteger('ingredient_id')->nullable()->unsigned();
            $table->decimal('in_g', 8, 4)->unsigned()->default(0);
        });
        Schema::create('mcgo_recipe_nutrition_informations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nutriable_type')->nullable();
            $table->bigInteger('nutriable_id')->nullable()->unsigned();

            $table->decimal('values_per_g')->default(100)->unsigned();

            $table->decimal('energy_kcal')->nullable()->unsigned();
            $table->decimal('energy_kj')->nullable()->unsigned();
            $table->decimal('energy_kcal_per_g')->nullable()->unsigned();

            // Makro
            $table->decimal('eiweiss_g')->nullable()->unsigned();

            $table->decimal('fett_gesamt_g')->nullable()->unsigned();
            $table->decimal('fett_gfs_g')->nullable()->unsigned();
            $table->decimal('fett_eufs_g')->nullable()->unsigned();
            $table->decimal('fett_mufs_g')->nullable()->unsigned();
            $table->decimal('fett_chol_mg')->nullable()->unsigned();

            $table->decimal('kohlenhydrate_gesamt_g')->nullable()->unsigned();
            $table->decimal('kohlenhydrate_mono_di_g')->nullable()->unsigned();
            $table->decimal('kohlenhydrate_poly_g')->nullable()->unsigned();
            $table->decimal('kohlenhydrate_ball_g')->nullable()->unsigned();

            $table->decimal('kohlenhydrate_nacl_mg')->nullable()->unsigned();
            $table->decimal('alkohol_g')->nullable()->unsigned();
            $table->decimal('wasser_g')->nullable()->unsigned();
            $table->decimal('portion_g')->nullable()->unsigned();

            // Mineralstoffe
            $table->decimal('min_na_mg', 12, 4)->nullable()->unsigned();
            $table->decimal('min_k_mg', 8, 4)->nullable()->unsigned();
            $table->decimal('min_ca_mg', 8, 4)->nullable()->unsigned();
            $table->decimal('min_mg_mg', 8, 4)->nullable()->unsigned();
            $table->decimal('min_p_mg', 8, 4)->nullable()->unsigned();
            $table->decimal('min_fe_mg', 8, 4)->nullable()->unsigned();
            $table->decimal('min_zn_mg', 8, 4)->nullable()->unsigned();

            // Vitamine
            $table->decimal('vitamin_ret_µg', 8, 4)->nullable()->unsigned();
            $table->decimal('vitamin_caro_µg', 8, 4)->nullable()->unsigned();
            $table->decimal('vitamin_e_mg', 8, 4)->nullable()->unsigned();
            $table->decimal('vitamin_b1_mg', 8, 4)->nullable()->unsigned();
            $table->decimal('vitamin_b2_mg', 8, 4)->nullable()->unsigned();
            $table->decimal('vitamin_b6_mg', 8, 4)->nullable()->unsigned();
            $table->decimal('vitamin_b12_µg', 8, 4)->nullable()->unsigned();
            $table->decimal('vitamin_fol_µg', 8, 4)->nullable()->unsigned();
            $table->decimal('vitamin_c_mg', 8, 4)->nullable()->unsigned();


            $table->unique(['nutriable_type', 'nutriable_id'], 'unique_nutriable');
        });

        Schema::create('mcgo_recipe_ingredienttype_food', function (Blueprint $table) {
            $table->bigIncrements('id');
        });
        Schema::create('mcgo_recipe_ingredienttype_nourishment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ean_code')->unsigned()->nullable();
            $table->string('brand')->nullable();
            $table->string('image')->nullable();
        });
        Schema::create('mcgo_recipe_ingredientfood_season', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('food_id');
            $table->string('country_code')->default('de');
            $table->integer('season_january')->default(0);
            $table->integer('season_february')->default(0);
            $table->integer('season_march')->default(0);
            $table->integer('season_april')->default(0);
            $table->integer('season_may')->default(0);
            $table->integer('season_june')->default(0);
            $table->integer('season_july')->default(0);
            $table->integer('season_august')->default(0);
            $table->integer('season_september')->default(0);
            $table->integer('season_october')->default(0);
            $table->integer('season_november')->default(0);
            $table->integer('season_december')->default(0);

        });

    }

};
