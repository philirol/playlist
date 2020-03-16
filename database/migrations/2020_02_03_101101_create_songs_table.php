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
        /*pour test de départ :
        Schema::create('songs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('content');
            $table->unsignedBigInteger('band_id');
            $table->timestamps();
        });
        */

        Schema::disableForeignKeyConstraints();
        Schema::create('songs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('band_id')->nullable();   
                $table->foreign('band_id')
                ->references('id')
                ->on('bands')
                ->onDelete('cascade')
                ->onUpdate('cascade');  
            $table->unsignedBigInteger('user_id')->nullable();    
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');            
            $table->string('title', 70);
            $table->string('url',400)->nullable();
            $table->tinyInteger('type')->unsigned()->default(0);
            $table->string('file', 400)->nullable();         
            $table->integer('order')->default(0);
            $table->boolean('list')->default(true);
            $table->text('comments', 1000)->nullable();
            $table->tinyInteger('songsub')->unsigned()->default(0);
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
        Schema::dropIfExists('songs');
    }
}
