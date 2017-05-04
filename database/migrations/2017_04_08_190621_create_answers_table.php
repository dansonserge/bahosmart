<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('answers', function(Blueprint $table){
            $table->increments('id');
            $table->integer('question_id')->unsigned();
            $table->string('answer_text');
            $table->boolean('is_correct');
            $table->integer('status')->default(1);
            $table->timestamps();
        });


        /**
         * Status
         *  0: unread
         *  1: read
         *
         */

           Schema::table('answers', function(Blueprint $table){
            $table->foreign('question_id')->references('id')->on('questions');
           });
    }

    /**
     * Reverse the migrations.
     
     * @return void
     */
    public function down()
    {
        Schema::drop('answers');
    }
}
