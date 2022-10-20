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
            $table->decimal('in_g',8,4)->unsigned()->default(0);
            $table->text('description')->nullable();
        });
        Schema::create('mcgo_recipe_ingredient_unit_weights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('unit_id')->nullable()->unsigned();
            $table->bigInteger('ingredient_id')->nullable()->unsigned();
            $table->decimal('in_g',8,4)->unsigned()->default(0);
        });
        Schema::create('mcgo_recipe_nutrition_informations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nutriable_type')->nullable();
            $table->bigInteger('nutriable_id')->nullable()->unsigned();

            $table->decimal('values_per_g')->default(100)->unsigned();

            $table->decimal('calories')->nullable()->unsigned();

            // Makro
            $table->decimal('fett_g')->nullable()->unsigned();
            $table->decimal('kohlenhydrate_g')->nullable()->unsigned();
            $table->decimal('zucker_g')->nullable()->unsigned();
            $table->decimal('eiweiss_g')->nullable()->unsigned();

            $table->decimal('ballaststoffe_g')->nullable()->unsigned();

            // Vitamine
            $table->decimal('vitamin_c_mg', 8,4)->nullable()->unsigned();
            $table->decimal('vitamin_a_mg', 8,4)->nullable()->unsigned();
            $table->decimal('vitamin_e_mg', 8,4)->nullable()->unsigned();
            $table->decimal('vitamin_b1_mg', 8,4)->nullable()->unsigned();
            $table->decimal('vitamin_b2_mg', 8,4)->nullable()->unsigned();
            $table->decimal('vitamin_b6_mg', 8,4)->nullable()->unsigned();
            $table->decimal('vitamin_b12_mg', 8,4)->nullable()->unsigned();

            // Mineralstoffe
            $table->decimal('min_natrium_g', 8,4)->nullable()->unsigned();
            $table->decimal('min_eisen_g', 8,4)->nullable()->unsigned();
            $table->decimal('min_zink_g', 8,4)->nullable()->unsigned();
            $table->decimal('min_magnesium_g', 8,4)->nullable()->unsigned();
            $table->decimal('min_chlorid_g', 8,4)->nullable()->unsigned();
            $table->decimal('min_mangan_g', 8,4)->nullable()->unsigned();
            $table->decimal('min_kalium_g', 8,4)->nullable()->unsigned();
            $table->decimal('min_kalzium_g', 8,4)->nullable()->unsigned();
            $table->decimal('min_phosphor_g', 8,4)->nullable()->unsigned();
            $table->decimal('min_kupfer_g', 8,4)->nullable()->unsigned();
            $table->decimal('min_jod_g', 8,4)->nullable()->unsigned();

            $table->unique(['nutriable_type', 'nutriable_id'], 'unique_nutriable');
        });

        Schema::create('mcgo_recipe_ingredienttype_food', function (Blueprint $table) {
            $table->bigIncrements('id');
        });
        Schema::create('mcgo_recipe_ingredienttype_nourishment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ean_code')->nullable();
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

        $this->generateDefaultUnits();
    }

    public function generateDefaultUnits() {
        \McGo\Recipe\Models\Unit::create([
            'name'=> 'EL',
            'in_g' => 15
        ]);
        \McGo\Recipe\Models\Unit::create([
            'name'=> 'TL',
            'in_g' => 5
        ]);

        \McGo\Recipe\Models\Unit::create([
            'name'=> 'l',
            'in_g' => 1000
        ]);
        \McGo\Recipe\Models\Unit::create([
            'name'=> 'ml',
            'in_g' => 1
        ]);

        \McGo\Recipe\Models\Unit::create([
            'name'=> 'kg',
            'in_g' => 1000
        ]);
        \McGo\Recipe\Models\Unit::create([
            'name'=> 'g',
            'in_g' => 1
        ]);
        \McGo\Recipe\Models\Unit::create([
            'name'=> 'mg',
            'in_g' => .001
        ]);
        \McGo\Recipe\Models\Unit::create([
            'name'=> 'Handvoll',
            'in_g' => 75
        ]);

        // Special things that could not be weight
        \McGo\Recipe\Models\Unit::create(['name'=> 'Prise']);
        \McGo\Recipe\Models\Unit::create(['name'=> 'Pck.']);
        \McGo\Recipe\Models\Unit::create(['name'=> 'Pck']);
        \McGo\Recipe\Models\Unit::create(['name'=> 'Packung']);
        \McGo\Recipe\Models\Unit::create(['name'=> 'Paket']);
        \McGo\Recipe\Models\Unit::create(['name'=> 'Becher']);
    }
};
