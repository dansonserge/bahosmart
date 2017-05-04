<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('follows', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('follows_user_id')->unsigned();

            $table->timestamps();
        });

         Schema::table('follows',function(Blueprint $table){
           $table->foreign('user_id')->references('id')->on('users');
          $table->foreign('follows_user_id')->references('id')->on('users');
          });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('follows');
    }
}
