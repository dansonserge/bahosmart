<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('messages', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('room_id')->unsigned();
            $table->integer('sender_id')->unsigned();
            $table->integer('receiver_id');
            $table->string('chat');
            $table->boolean('read')->default(0);
            $table->boolean('deleted')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
       

        });

        Schema::table('messages',function(Blueprint $table){

            $table->foreign('room_id')->references('id')->on('rooms');
             $table->foreign('sender_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('messages');
    }
}



















