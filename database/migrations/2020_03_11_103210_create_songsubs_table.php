<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songsubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('song_id')->nullable();   
            $table->foreign('song_id')
                ->references('id')
                ->on('songs');
                $table->unsignedBigInteger('user_id')->nullable();    
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->unsignedBigInteger('band_id')->nullable();    
                $table->foreign('band_id')
                ->references('id')
                ->on('bands'); 
            $table->boolean('main')->default(false); 
            $table->string('title', 70);
            $table->tinyInteger('type')->unsigned()->default(0);
            $table->string('url',400)->nullable();
            $table->string('file', 400)->nullable();  
            $table->bigInteger('filesize')->nullable(); 
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
        Schema::dropIfExists('songsubs');
    }
}
