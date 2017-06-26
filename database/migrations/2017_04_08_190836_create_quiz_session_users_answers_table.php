<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizSessionUsersAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('quiz_session_users_answers', function(Blueprint $table){
           
            $table->increments('id');
              
            $table->integer('quiz_session_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->integer('answer_id')->unsigned()->nullable();

            $table->integer('status')->default(0);
            $table->timestamps(); 
         });


        Schema::table('quiz_session_users_answers',function(Blueprint $table){
            $table->foreign('quiz_session_id')->references('id')->on('quiz_session');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('answer_id')->references('id')->on('answers');
           });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quiz_session_users_answers');
    }
}
