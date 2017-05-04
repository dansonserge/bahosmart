<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizSessionQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
         Schema::create('quiz_session_questions', function(Blueprint $table){
            $table->increments('id');
              
            $table->integer('quiz_session_id')->unsigned();

            $table->integer('question_id')->unsigned();
            $table->integer('status')->default(0);
            $table->timestamps(); 
         });

       /**
         * Status
         *  0: unapproved
         *  1: approved
         *
         */

          Schema::table('quiz_session_questions', function(Blueprint $table){
            $table->foreign('quiz_session_id')->references('id')->on('quiz_session');
            $table->foreign('question_id')->references('id')->on('questions');
           });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quiz_session_questions');
    }
}
