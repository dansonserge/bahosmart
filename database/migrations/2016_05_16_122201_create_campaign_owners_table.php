<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('campaign_owner', function(Blueprint $table){
        $table->increments('id');
        $table->integer('campaign_id')->unsigned();
        $table->integer('user_id')->unsigned();
        $table->timestamps();
       });

       Schema::table('campaign_owner', function(Blueprint $table){

            $table->foreign('campaign_id')->references('id')->on('campaigns');
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
        Schema::drop('campaign_owner'); 
    }
}
