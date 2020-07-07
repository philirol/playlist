<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedBigInteger('band_id')->nullable();    
                $table->foreign('band_id')
                ->references('id')
                ->on('bands');
            $table->string('name',255);       
            $table->tinyInteger('type')->default(0);        
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('filesize')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medias');
    }
}
