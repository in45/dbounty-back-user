<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('public_address')->primary();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('avatar')->default("http://via.placeholder.com/640x480.png/14C9AC?text=hunter");
            $table->unsignedInteger('score')->default(0);
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('first_time_login')->default(1);
            $table->boolean('is_verified')->default(0);
            $table->string('username_linkedin')->nullable();
            $table->string('username_github')->nullable();
            $table->string('username_crisis')->nullable();
            $table->boolean('state')->default(1);//1:normal,0:banned
            $table->string('link_nic')->nullable(); //national identity card
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
