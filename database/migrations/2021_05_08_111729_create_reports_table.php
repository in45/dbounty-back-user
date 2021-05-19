<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('target');
            $table->integer('vuln_id')->nullable();
            $table->string('user_address');
            $table->integer('prog_id');
            $table->string('vuln_name')->nullable();
            $table->text('vuln_details')->nullable();
            $table->text('validation_steps');
            $table->string('severity');//low,medium,high,critical
            $table->string('file_upload')->nullable();
            $table->string('status')->default('new');//new,needs more info,triaged,resolved,accepted,duplicate,informative,not applicable
             $table->string('assigned_to_admin')->nullable();
            $table->string('assigned_to_manager')->nullable();
            $table->integer('bounty_win')->nullable();//tokens
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
        Schema::dropIfExists('reports');
    }
}
