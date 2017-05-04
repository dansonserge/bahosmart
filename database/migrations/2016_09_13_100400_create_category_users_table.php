<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */


    // A table of users following categories 

    
    public function up()
    {
        Schema::create('category_users', function(Blueprint $table){
        $table->increments('id');
        $table->integer('user_id')->unsigned();
        $table->integer('category_id')->unsigned();
        $table->timestamps();
       });

       Schema::table('category_users', function(Blueprint $table){

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
           
     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('category_users');
    }
}
