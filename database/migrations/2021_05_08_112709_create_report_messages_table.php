<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_messages', function (Blueprint $table) {
            $table->id();
            $table->integer('report_id');
            $table->uuid('from');
            $table->uuid('to');
            $table->text('message');
            $table->string('type')->nullable();// am,au,ma,mu,ua,um
            $table->string('attachment')->nullable();
            $table->boolean('read')->default(0);
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
        Schema::dropIfExists('report_messages');
    }
}
