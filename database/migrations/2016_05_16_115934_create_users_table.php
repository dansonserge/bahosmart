<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('profile_picture')->default('images/default-profile-male.gif');
            $table->string('status')->default("I\'m available, at BahoSmart app");
            $table->string('country')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->unique();
            $table->string('password');

            $table->integer('user_type')->default(0);
            $table->boolean('isBlocked')->default(0);
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
