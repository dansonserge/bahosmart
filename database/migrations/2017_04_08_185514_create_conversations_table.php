<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('conversations', function(Blueprint $table){
        $table->increments('id');
        $table->integer('user_one_id')->unsigned();
        $table->integer('user_two_id')->unsigned();
        $table->integer('status')->default(0);

        $table->timestamps();
       });


        /**
         * Status
         *
         */

 Schema::table('conversations', function(Blueprint $table){

            $table->foreign('user_one_id')->references('id')->on('users');
            $table->foreign('user_two_id')->references('id')->on('users');
           
    });
   }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('conversations');
    }
}
