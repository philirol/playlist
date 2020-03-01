<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::create('bands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bandname');
            $table->timestamps();
        });*/

        Schema::create('bands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bandname');
            $table->string('slug');
            $table->string('deposit_file')->nullable($value=true);
            $table->unsignedBigInteger('ville_id');
            $table->foreign('ville_id')
                ->references('id')
                ->on('villes')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bands');
    }
}
