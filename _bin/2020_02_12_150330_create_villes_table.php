<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('villes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('ville_departement', 3)->nullable()->index('ville_departement');
			$table->string('ville_slug')->nullable()->unique('ville_slug');
			$table->string('ville_nom', 45)->nullable()->index('ville_nom');
			$table->string('ville_nom_simple', 45)->nullable()->index('ville_nom_simple');
			$table->string('ville_nom_reel', 45)->nullable()->index('ville_nom_reel');
			$table->string('ville_nom_soundex', 20)->nullable()->index('ville_nom_soundex');
			$table->string('ville_nom_metaphone', 22)->nullable()->index('ville_nom_metaphone');
			$table->string('ville_code_postal')->nullable()->index('ville_code_postal');
			$table->string('ville_commune', 3)->nullable();
			$table->string('ville_code_commune', 5)->unique('ville_code_commune_2');
			$table->smallInteger('ville_arrondissement')->unsigned()->nullable();
			$table->string('ville_canton', 4)->nullable();
			$table->smallInteger('ville_amdi')->unsigned()->nullable();
			$table->integer('ville_population_2010')->unsigned()->nullable()->index('ville_population_2010');
			$table->integer('ville_population_1999')->unsigned()->nullable();
			$table->integer('ville_population_2012')->unsigned()->nullable()->comment('approximatif');
			$table->integer('ville_densite_2010')->nullable();
			$table->float('ville_surface', 10, 0)->nullable();
			$table->float('ville_longitude_deg', 10, 0)->nullable();
			$table->float('ville_latitude_deg', 10, 0)->nullable();
			$table->string('ville_longitude_grd', 9)->nullable();
			$table->string('ville_latitude_grd', 8)->nullable();
			$table->string('ville_longitude_dms', 9)->nullable();
			$table->string('ville_latitude_dms', 8)->nullable();
			$table->integer('ville_zmin')->nullable();
			$table->integer('ville_zmax')->nullable();
			$table->index(['ville_longitude_deg','ville_latitude_deg'], 'ville_longitude_latitude_deg');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('villes');
    }
}
