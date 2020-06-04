<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('songs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('band_id')->nullable();   
                $table->foreign('band_id')
                ->references('id')
                ->on('bands');  
            $table->unsignedBigInteger('user_id')->nullable();    
            $table->foreign('user_id')
                ->references('id')
                ->on('users');            
            $table->string('title', 70);         
            $table->integer('order')->default(0);
            $table->boolean('list')->default(true);
            $table->text('comments', 1000)->nullable();
            $table->tinyInteger('songsub')->unsigned()->default(0);
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
        Schema::dropIfExists('songs');
    }
}
