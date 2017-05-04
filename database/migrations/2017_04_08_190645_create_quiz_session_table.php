<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizSessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('quiz_session', function(Blueprint $table){
            $table->increments('id');

            $table->integer('pack_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('user_one_id')->unsigned();
            $table->integer('user_two_id')->unsigned();
            $table->integer('status')->default(1);
            $table->integer('user_one_start')->default(0);
            $table->integer('user_two_start')->default(0);
            $table->timestamps(); 
        });


        /**
         * Status
         *  0: unapproved
         *  1: approved
         *
         */

           Schema::table('quiz_session', function(Blueprint $table){
                $table->foreign('pack_id')->references('id')->on('packs');
                $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::drop('quiz_session');
    }
}
