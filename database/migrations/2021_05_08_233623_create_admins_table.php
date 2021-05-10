<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->string('compte_address')->primary();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('avatar')->default("http://via.placeholder.com/640x480.png/0000ff?text=admin");
            $table->boolean('first_time_login')->default(1);
            $table->string('role')->nullable();//sudo : all permissions,sysmanage : manage reports,sysmoni : monitoring
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
        Schema::dropIfExists('admins');
    }
}
