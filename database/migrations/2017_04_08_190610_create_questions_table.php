<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function(Blueprint $table){
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('expert_id')->unsigned();
            $table->integer('status')->default(0);
            $table->string('question_text');
            $table->timestamps();
        });


        /**
         * Status
         *  0: unread
         *  1: read
         */
           Schema::table('questions', function(Blueprint $table){
              $table->foreign('category_id')->references('id')->on('categories');
              $table->foreign('expert_id')->references('id')->on('users');
             });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('questions');
    }
}
