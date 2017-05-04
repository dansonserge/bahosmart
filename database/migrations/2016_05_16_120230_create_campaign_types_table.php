<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignTypesTable extends Migration
{
   
   public function up()
    {
        Schema::create('campaign_types', function(Blueprint $table){
        $table->increments('id');
        $table->string('title');
        $table->integer('amount');
        $table->timestamps();
       });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('campaign_types'); 
    }
}
