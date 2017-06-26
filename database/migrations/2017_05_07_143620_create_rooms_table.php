<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms',function(Blueprint $table){
        
        $table->increments('id');
        $table->string('room_type')->default('private');
        $table->string('room_picture')->nullable();
        $table->integer('status')->default(1);
        $table->integer('user_one')->nullable();
        $table->integer('user_two')->nullable();
        $table->boolean('deleted')->default(0);
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
        Schema::drop('rooms'); 
    }
}
