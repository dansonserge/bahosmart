<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
             $table->string('title');
            $table->string('post_text');
            $table->string('image');
            $table->boolean('deleted')->default('0');
            $table->timestamps();
        });

        
        
    Schema::table('posts', function(Blueprint $table) {
        $table->foreign('user_id')->references('id')->on('users');
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        

      
      });

        


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');

    }
}
