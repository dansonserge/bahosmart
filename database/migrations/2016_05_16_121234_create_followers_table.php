<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('followers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('isfollowed_user_id')->unsigned();
            $table->timestamps();
            });


         Schema::table('followers', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('isfollowed_user_id')->references('id')->on('users');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('followers');
    }
}
