<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('campaign_user', function(Blueprint $table){
        $table->increments('id');
        $table->integer('user_id')->unsigned();
        $table->integer('campaign_id')->unsigned();
        $table->timestamps();
       });

       Schema::table('campaign_user', function(Blueprint $table){

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::drop('campaign_user');
    }
}
