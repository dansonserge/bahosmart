<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminExpertTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_expert',function(Blueprint $table){
        $table->increments('id');
       
        $table->integer('admin_id')->unsigned();
        $table->integer('application_id')->unsigned();
     
        $table->string('action');
        $table->string('reason')->nullable();
        $table->timestamps();
        });

       Schema::table('admin_expert', function(Blueprint $table){

            $table->foreign('admin_id')->references('id')->on('users');
            $table->foreign('application_id')->references('id')->on('category_expert');
      
         });
   
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admin_expert');
    }
}
