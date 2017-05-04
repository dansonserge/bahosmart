<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_images', function(Blueprint $table){
        $table->increments('id');
        $table->integer('campaign_id')->unsigned();
        $table->string('image');
        $table->timestamps();
       });

       Schema::table('campaign_images', function(Blueprint $table){

            $table->foreign('campaign_id')->references('id')->on('campaigns');
           
     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('campaign_images'); 
    }
}
