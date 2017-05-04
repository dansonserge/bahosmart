<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reported', function(Blueprint $table){
        $table->increments('id');
        $table->integer('reporter_id')->unsigned();
        $table->integer('reported_post_id')->unsigned();
        $table->timestamps();
       });

       Schema::table('reported', function(Blueprint $table){

            $table->foreign('reporter_id')->references('id')->on('users');


            $table->foreign('reported_post_id')->references('id')->on('posts');
     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reported'); 
    }
}
