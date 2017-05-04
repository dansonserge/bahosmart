<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns',function(Blueprint $table){
              $table->increments('id');
              $table->integer('camp_type_id')->unsigned();
              $table->string('business_name');
              $table->string('header_image');
              $table->string('title');
              $table->string('description');
              $table->integer('amount');
              $table->timestamps();
             });
        Schema::table('campaigns',function(Blueprint $table){
            $table->foreign('camp_type_id')->references('id')->on('campaign_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('campaigns');
    }
}
