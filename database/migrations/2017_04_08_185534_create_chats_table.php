<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('chats', function(Blueprint $table){
        $table->increments('id');
        $table->integer('conversation_id')->unsigned();
        $table->integer('user_id')->unsigned();
        $table->integer('status')->default(0);
        $table->timestamps();
       });


        /**
         * Status
         *  0: unread
         *  1: read
         */


       Schema::table('chats', function(Blueprint $table){

            $table->foreign('conversation_id')->references('id')->on('conversations');
            $table->foreign('user_id')->references('id')->on('users');
           
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('chats');
    }
}
