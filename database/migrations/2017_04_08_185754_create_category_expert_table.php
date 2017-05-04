<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryExpertTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('category_expert', function(Blueprint $table){
        $table->increments('id');
        $table->integer('category_id')->unsigned();
        $table->integer('user_id')->unsigned();
        
        $table->string('educational_background');
        $table->string('description');

        

        $table->integer('status')->default(0);
        $table->timestamps();
       });


        /**
         * Status
         *  0: unread
         *  1: read
         */
           Schema::table('category_expert', function(Blueprint $table){

                $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::drop('category_expert');
    }
}
